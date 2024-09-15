<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\MetabaseDatabase;
use app\models\MetabaseTable;
use app\models\MetabaseField;
use app\models\ReportDashboard;
use app\models\ReportCard;
use app\models\DashboardTab;
use app\models\ReportDashboardcard;
use app\models\CloneForm;

class DatabaseController extends Controller
{
    public function actionClone()
    {
        $model = new CloneForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $db = $this->findModel($model->source_db_id);

            // Create new database record
            $newDb = new MetabaseDatabase();
            $newDb->name = $model->new_db_name;
            $newDb->save();

            // Clone tables
            foreach ($db->tables as $table) {
                $newTable = new MetabaseTable();
                $newTable->name = $table->name;
                $newTable->db = $newDb->id;
                $newTable->save();

                // Clone fields
                foreach ($table->fields as $field) {
                    $newField = new MetabaseField();
                    $newField->name = $field->name;
                    $newField->table_id = $newTable->id;
                    $newField->save();
                }
            }

            // Clone dashboards
            foreach (ReportDashboard::find()->where(['db' => $model->source_db_id])->all() as $dashboard) {
                $newDashboard = new ReportDashboard();
                $newDashboard->name = $dashboard->name;
                $newDashboard->save();

                // Clone cards
                foreach ($dashboard->cards as $card) {
                    $newCard = new ReportCard();
                    $newCard->name = $card->name;
                    $newCard->dashboard_id = $newDashboard->id;
                    $newCard->save();

                    // Clone dashboard cards
                    foreach (ReportDashboardcard::find()->where(['card_id' => $card->id])->all() as $dashboardCard) {
                        $newDashboardCard = new ReportDashboardcard();
                        $newDashboardCard->dashboard_id = $newDashboard->id;
                        $newDashboardCard->card_id = $newCard->id;
                        $newDashboardCard->save();
                    }
                }

                // Clone tabs
                foreach ($dashboard->tabs as $tab) {
                    $newTab = new DashboardTab();
                    $newTab->name = $tab->name;
                    $newTab->dashboard_id = $newDashboard->id;
                    $newTab->save();
                }
            }

            return $this->redirect(['view', 'id' => $newDb->id]);
        }

        return $this->render('clone', [
            'model' => $model,
            'databases' => MetabaseDatabase::find()->all(), // Pass all databases for selection
        ]);
    }

    protected function findModel($id)
    {
        if (($model = MetabaseDatabase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
