<?php

namespace app\controllers;

use Yii;
use app\models\MetabaseDatabase;
use app\models\ReportCard;
use app\models\MetabaseTable;
use app\models\MetabaseField;
use app\models\DashboardTab;
use app\models\ReportDashboard;
use app\models\ReportDashboardcard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DatabaseController extends Controller
{
    public function actionClone()
    {
        $model = new MetabaseDatabase();

        if ($model->load(Yii::$app->request->post())) {
            $existingDatabaseId = $model->existing_database_id;
            $newDatabaseName = $model->new_database_name;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Clone MetabaseDatabase
                $existingDatabase = MetabaseDatabase::findOne($existingDatabaseId);
                if (!$existingDatabase) {
                    throw new NotFoundHttpException('The requested database does not exist.');
                }

                $newDatabase = new MetabaseDatabase();
                $newDatabase->attributes = $existingDatabase->attributes;
                $newDatabase->name = $newDatabaseName;
                $newDatabase->save(false);

                // Clone related MetabaseTables
                $tables = MetabaseTable::find()->where(['database_id' => $existingDatabaseId])->all();
                foreach ($tables as $table) {
                    $newTable = new MetabaseTable();
                    $newTable->attributes = $table->attributes;
                    $newTable->database_id = $newDatabase->id;
                    $newTable->id = null; // Ensure ID is not set
                    $newTable->save(false);

                    // Clone related MetabaseFields for each table
                    $fields = MetabaseField::find()->where(['table_id' => $table->id])->all();
                    foreach ($fields as $field) {
                        $newField = new MetabaseField();
                        $newField->attributes = $field->attributes;
                        $newField->table_id = $newTable->id;
                        $newField->id = null;
                        $newField->save(false);
                    }
                }

                // Clone ReportCard
                $cards = ReportCard::find()->where(['database_id' => $existingDatabaseId])->all();
                foreach ($cards as $card) {
                    $newCard = new ReportCard();
                    $newCard->attributes = $card->attributes;
                    $newCard->database_id = $newDatabase->id;
                    $newCard->save(false);
                }

                // Clone ReportDashboard
                $dashboards = ReportDashboard::find()->where(['database_id' => $existingDatabaseId])->all();
                foreach ($dashboards as $dashboard) {
                    $newDashboard = new ReportDashboard();
                    $newDashboard->attributes = $dashboard->attributes;
                    $newDashboard->database_id = $newDatabase->id;
                    $newDashboard->save(false);

                    // Clone DashboardTabs
                    $tabs = DashboardTab::find()->where(['dashboard_id' => $dashboard->id])->all();
                    foreach ($tabs as $tab) {
                        $newTab = new DashboardTab();
                        $newTab->attributes = $tab->attributes;
                        $newTab->dashboard_id = $newDashboard->id;
                        $newTab->save(false);
                    }

                    // Clone ReportDashboardCard
                    $dashboardCards = ReportDashboardcard::find()->where(['dashboard_id' => $dashboard->id])->all();
                    foreach ($dashboardCards as $dashboardCard) {
                        $newDashboardCard = new ReportDashboardcard();
                        $newDashboardCard->attributes = $dashboardCard->attributes;
                        $newDashboardCard->dashboard_id = $newDashboard->id;
                        $newDashboardCard->save(false);
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Metabase Database cloned successfully.');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Error occurred: ' . $e->getMessage());
            }
        }

        return $this->render('clone', [
            'model' => $model,
        ]);
    }
}
