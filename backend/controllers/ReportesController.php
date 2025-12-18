<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Equipos; // Ajusta según tu namespace
use common\models\Departamentos;
use common\models\Asignacion;
use common\models\BajaEquipo;

class ReportesController extends Controller
{
    // Usaremos un layout limpio para imprimir
    public $layout = 'print'; 

    public function actionIndex()
    {
        // Para el index usamos el layout normal con menú
        $this->layout = 'main'; 
        return $this->render('index');
    }

    // 1. REPORTE GENERAL (Inventario Completo)
    public function actionGeneral()
    {
        // Buscamos todos los equipos con sus relaciones para evitar muchas consultas
        $equipos = Equipos::find()
            ->joinWith(['modelo.marca', 'tipoEquipo', 'estadoEquipo', 'asignacion.departamento', 'bajaEquipo'])
            ->all();

        return $this->render('general', [
            'equipos' => $equipos,
            'fecha' => date('d/m/Y')
        ]);
    }

    // 2. REPORTE POR DEPARTAMENTOS (Tu botón dice 'estado', pero el título es Departamentos)
    public function actionEstado()
    {
        // Buscamos departamentos que tengan asignaciones activas
        $departamentos = Departamentos::find()
            ->joinWith(['asignacions.equipo' => function($q) {
                // Solo traemos equipos que NO estén dados de baja
                $q->joinWith('bajaEquipo')->where(['baja_equipo.id' => null]);
            }])
            ->all();

        // Aparte, buscamos los dados de baja y en almacén para el resumen
        $bajas = BajaEquipo::find()->count();
        $total = Equipos::find()->count();

        return $this->render('estado', [
            'departamentos' => $departamentos,
            'bajas' => $bajas,
            'total' => $total,
            'fecha' => date('d/m/Y')
        ]);
    }

    // 3. EXPEDIENTES DE ALUMNOS (Simulación)
    public function actionExpedientes()
    {
        // Como simulamos que no hay alumnos con equipos aún, pasamos un array vacío
        // O podrías hacer la consulta real si tuvieras datos en la tabla 'asignaciones_alumnos_grupos'
        $alumnos = []; 

        return $this->render('expedientes', [
            'alumnos' => $alumnos,
            'fecha' => date('d/m/Y')
        ]);
    }
}