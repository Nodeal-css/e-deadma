<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS  -->
    <link rel="stylesheet" href="css/admin.css">

    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="assets/KG.png" alt="">
            </div>
            <span class="logo_name">Grave.ly</span>

        </div>


        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="adminDeceasedRecords.php">
                    <i class="uil uil-folder"></i>
                    <span class="link-name">Deceased Records</span>
                </a></li>
                <li><a href="adminPlotRecords.php">
                    <i class="uil uil-folder-open"></i>
                    <span class="link-name">Contracts</span>
                </a></li>
                <li><a href="adminCemeteryMap.php">
                    <i class="uil uil-location-point"></i>
                    <span class="link-name">Cemetery Map</span>
                </a></li>
                <li><a href="adminAccounting.php">
                    <i class="uil uil-bill"></i>
                    <span class="link-name">Accounting</span>
                </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name" onclick="logout();">Logout</span>
                </a></li>
            </ul>

        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search ReConnect">
            </div>
            <div>
                <p id="active-user" style="float:left;margin-top: 20px;margin-right: 10px;"></p>
                <img src="assets/adminprofile.png" alt="">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-estate"></i>
                    <span class="text" id="logo_cem_name">Dashboard</span>
                </div>

                <div class="w3-card-4 w3-row">
                  <div class="w3-col s7" id="curve_chart" style="width: 550px; height: 400px"></div>
                  <div class="w3-col s5" style="padding-top: 40px;">
                      <div style="font-size: 10px; height: 160px; overflow: scroll;">
                          <header><b>Journal entry</b></header>
                            <table class="w3-table" id="journal-table">

                            </table>
                      </div><br>
                      <div style="font-size: 10px; height: 160px; overflow: scroll;">
                          <header><b>Report</b></header>
                          <table class="w3-table" id="financial-report">
                              
                          </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>


<!-- Javascript starts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  $(document).ready(function(){
    checkSession();
    getSession();

    getAllJournal();
    getAllFinancialReport();
  });

  // this function checks for session, will automatically load with the document
  function checkSession(){
    var req = "check";
    $.ajax({
      url:'includes/checkSession.php',
      type:'post',
      data:{
        request:req
      },
      success:function(data, status){
        if(data != 'true'){
          alert('The session is INVALID');

          window.location.href = "adminlogin.php";
        }
      }
    });
  }

  // function for logging out, will unset the session to the server
  function logout(){
    var req = 'logout';
    if(confirm('Proceed signing out?')){
      $.ajax({
        url:'includes/checkSession.php',
        type:'post',
        data:{
          logout:req
        },
        success:function(data, status){
          if(data == 'logout'){
            window.location.href = "adminlogin.php";
          }
        }
      });
    }
  }

  //Get the session user id and cemetery id to display
  function getSession(){
    var check = "req";
    $.post({
        url:'includes/getSession.php',
        data:{
            request:check
        },
        success:function(data, status){
            var obj = JSON.parse(data);
            $("#logo_cem_name").html(obj.cemetery_name);
            $("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        }
    });
  }

// Populate drawChart values from database using ajax
//https://developers.google.com/chart/interactive/docs/gallery/linechart
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var obj;
        $.ajax({
            type: 'post',
            url: 'includes/getAllGraphdata.php',
            data: {
                request: 'graph'
            },
            success:function(result, status){
              obj = JSON.parse(result);
			  if(obj.length >= 5){
              var data = google.visualization.arrayToDataTable([
                ['Month', 'Revenue', 'Expenses'],
                [obj[4][3],  parseFloat(obj[4][4]),    parseFloat(obj[4][5])],
                [obj[3][3],  parseFloat(obj[3][4]),    parseFloat(obj[3][5])],
                [obj[2][3],  parseFloat(obj[3][4]),    parseFloat(obj[3][5])],
                [obj[1][3],  parseFloat(obj[1][4]),    parseFloat(obj[1][5])],
                [obj[0][3],  parseFloat(obj[0][4]),    parseFloat(obj[0][5])]
              ]);

              var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
              };

              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

              chart.draw(data, options);
            }else{
				var data = google.visualization.arrayToDataTable([
                ['Month', 'Revenue', 'Expenses'],
                ["Month",  1,    1],
                ["Month",  1,    1],
                ["Month",  1,    1],
                ["Month",  1,    1],
                ["Month",  1,    1]
                ]);

              var options = {
                title: '\t\tMust exceed at least 5 months to display full graph',
                curveType: 'function',
                legend: { position: 'bottom' }
              };

              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

              chart.draw(data, options);
			}
			}
        });
      }

  //Function to display all journal entry in a table
  function getAllJournal(){
    $.ajax({
       type: 'post',
       url: 'includes/getAllJournal.php',
       data: {
          journal: 'journal'
       },
       success:function(result, status){
          $("#journal-table").html(result);
       }
    });
  }

  //display all journal but with parameter of financial report_id
  function getJournalFromReport(report_id){
    $.ajax({
       type: 'post',
       url: 'includes/getAllJournal.php',
       data: {
          report: report_id
       },
       success:function(result, status){
          $("#journal-table").html(result);
       }
    });
  }

  //Display all financial report
  function getAllFinancialReport(){
      $.ajax({
         type: 'post',
         url: 'includes/getAllFinancialReport.php',
         data: {
            request: 'financial'
         },
         success:function(result, status){
            $("#financial-report").html(result);
         }
      });
  }

  //Deleting a journal entry and will also update the total inside financial report
  function deleteJournal(journal_id){
    if(confirm('Do you want to delete this journal entry?')){
      $.ajax({
          type: 'post',
          url: 'includes/deleteJournal.php',
          data: {
              journal: journal_id
          },
          success:function(result, status){
              alert(result);
              getAllJournal();
              drawChart();
          }
      });
    }
  }

</script>
<!-- Javascript starts -->
</body>
</html>
