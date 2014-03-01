

<head>


<?php 
Yii::app() -> clientScript -> registerScriptFile(Yii::app() -> baseUrl . '/js/amcharts/amcharts/amcharts.js');
Yii::app() -> clientScript -> registerScriptFile(Yii::app() -> baseUrl . '/js/amcharts/amcharts/serial.js');
Yii::app() -> clientScript -> registerScriptFile(Yii::app() -> baseUrl . '/js/amcharts/amcharts/amstock.js');
Yii::app() -> clientScript -> registerScriptFile(Yii::app() -> baseUrl . '/js/metricas-evolution.js', CClientScript::POS_END);
Yii::app() -> clientScript -> registerScriptFile(Yii::app() -> baseUrl . '/js/underscore-min.js');

$utils= new Utils;




?>



       <script type="text/javascript">
            var chart;
            var chartData = [];

           

            AmCharts.ready(function () {

                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.pathToImages = "js/amcharts/amcharts/images/";
                chart.dataProvider = chartData;
                chart.categoryField = "date";
                  chart.startDuration = 0.5;
                chart.dataDateFormat = "YYYY-MM-DD";

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.equalSpacing = true;


                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisColor = "#DADADA";
                valueAxis.dashLength = 1;
                valueAxis.logarithmic = false; // this line makes axis logarithmic
                chart.addValueAxis(valueAxis);


              <?php 
              $planes=Plan::model()->findAll(array('order'=>'anioPlan'));
             foreach ($planes as $key) {
               $randomcolor =$utils->getColor();
               $record=Plan::model()->findByPK($key->id);
                
                   echo '  
                var graph = new AmCharts.AmGraph();
                
                graph.type = "smoothedLine";
                
                 graph.bullet = "round";
                graph.bulletSize = 1;
                
                graph.bulletBorderAlpha = 1;
                graph.bulletBorderThickness = 1;
                graph.lineThickness = 2;
                
                graph.bulletColor = "'.$randomcolor.'";
                graph.useLineColorForBulletBorder = true;
                
                
                
                
                graph.title ="'.$record->carrera->nombreCarrera.' - '.$record->anioPlan.'";
                graph.hidden = true;
                graph.valueField ="'.$key->id.'";
                graph.connect = false;
                graph.lineColor = "'.$randomcolor.'";
                chart.addGraph(graph);';
                    }?>



                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.graph = graph;
                chartScrollbar.scrollbarHeight = 30;
                chart.addChartScrollbar(chartScrollbar);

                

    
                // LEGEND
               var legend = new AmCharts.AmLegend();
               legend.marginLeft = 110;
               legend.useGraphSettings = true;
               chart.addLegend(legend);
              


                // WRITE
                chart.write("chartdiv");
            });



$('')
        </script>

</head>

<body>

<div class="titulo">
<h1>Evolución</h1>
</div>


<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Calendario', 'url'=>array('/metrica/calendar')),
        array('label'=>'Linea de tiempo', 'url'=>array('/metrica/timeline')),
        array('label'=>'Evolución', 'url'=>'#', 'active'=>true),
        
    ),
)); ?>




<div id="buttons">


 <?php $this->widget('bootstrap.widgets.TbButton', array(
   'buttonType'=>'button',
   'type'=>'action',
   
   'label'=>'1° Cuat.',
   'htmlOptions'=>array('onclick' => 'go2FirstCuat()'),
   )); ?>
 <?php $this->widget('bootstrap.widgets.TbButton', array(
   'buttonType'=>'button',
   'type'=>'action',
   
   'label'=>'2° Cuat.',
   'htmlOptions'=>array('onclick' => 'go2SecondCuat()'),
   )); ?>



 </div>
 

<div id="chartdiv" style="width: 100%; height: 600px;"></div>
  </div>


</body>