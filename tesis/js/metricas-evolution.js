var Subjects =  new Array();
var plans =  new Array();
var infoExams={};
var data=[];
var fadeTime=400;

function loadData () {
 
  chart.dataProvider = generateChartData();
  
  chart.validateData();
}

function parseDate(dateString) {
     // split the string get each field
     var dateArray = dateString.split("-");
     // now lets create a new Date instance, using year, month and day as parameters
     // month count starts with 0, so we have to convert the month number
     var date = new Date(Number(dateArray[0]), Number(dateArray[1]) - 1, Number(dateArray[2]));
     return date;
}

function generateChartData() {
        var chartData = [];

        for(key in infoExams) {
          k=key;    
        }

        fechas=infoExams[k];

          for (fecha in fechas) {
             obj={};
             date=date=parseDate(fecha);
              obj.date=date;
              
             for (key in infoExams) {
                
                obj[key]=infoExams[key][fecha];
               }
             chartData.push(obj);
          }
          
     return chartData;
  }


         

function getInfoFromServer() {
 var jsonStringSubjects = JSON.stringify(Subjects);
 var jsonStringPlans = JSON.stringify(plans);
 $.ajax({
  type: "POST",
  url: 'index.php?r=metrica/GetExamsEvolution',
  data: {materias:jsonStringSubjects, planes:jsonStringPlans}, 
  cache: false,

  success: function(respuesta){

   infoExams=respuesta.result;
   loadData();
   chart.zoom(0,304);

   
 }
});   
}



$( document ).ready(function() {
  
  getInfoFromServer();


   
});

/*
Cuando comienza la peticion ajax muestro la animacion de carga
*/


function go2FirstCuat() {
chart.zoom(0,140);

}

function go2SecondCuat() {
chart.zoom(150,304);

}