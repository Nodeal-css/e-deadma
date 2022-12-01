<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS  -->
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
     
    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">    
    <title>Accounting</title>
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
                <li><a href="adminDashboard.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="adminDeceasedRecords.php">
                    <i class="uil uil-folder"></i>
                    <span class="link-name">Deceased Records</span>
                </a></li>
                <li><a href="adminPlotRecords.php">
                    <i class="uil uil-folder-open"></i>
                    <span class="link-name">Plot Records</span>
                </a></li>
                <li><a href="adminCemeteryMap.php">
                    <i class="uil uil-location-point"></i>
                    <span class="link-name">Cemetery Map</span>
                </a></li>
                <li><a href="#">
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
                <!-- Start of accounting page workspace -->
                <div>
                    <div class="w3-card-2 w3-padding w3-round-xxlarge w3-row" style="width: 60%; margin: auto; background-color: #ff7f4dc7;">
                        <div class="w3-col s3 w3-padding">
                            <label for="transaction-id">Transaction</label><br><br><br>
                            <label for="ledger-expense-id">Ledger</label><br><br><br>
                            <label for="date-input">Date</label><br><br><br>
                            <label for="description-id">Description</label><br><br><br><br>
                            <label for="debit-id" id="label-debit">Debit</label>
                            <label for="credit-id" id="label-credit" style="display: none;">Credit</label><br>
                        </div>
                        <div class="w3-col s9 w3-padding">
                            <select class="w3-input" name="transaction" id="transaction-id" onchange="changeSelect();">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="EXPENSE">Expense</option>
                                <option value="REVENUE">Revenue</option>
                            </select><br>
                            
                            <select class="w3-input" name="ledger" id="ledger-id-expense">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="SALARY">Salary</option>
                                <option value="CONTRACTED_SERVICES">Contracted Services</option>
                                <option value="COMMISSION">Commision</option>
                                <option value="SECURITY">Security</option>
                                <option value="WATER">Water</option>
                                <option value="ELECTRIC">Electricity</option>
                                <option value="OIL&GAS">Oil & gas</option>
                                <option value="INTERNET">Internet</option>
                                <option value="MAINTENANCE_BUILDING">Maintenance of building</option>
                                <option value="OFFICE_SUPPLIES">Office supplies</option>
                                <option value="MAINTENANCE_EQUIPMENT">Maintenance of equipment</option>
                                <option value="SUBSCRIPTION">Subscription & licenses</option>
                                <option value="FACILITY">Facility operating supplies</option>
                                <option value="INSURANCE">Insurance</option>
                                <option value="BANK_PAYROLL">Bank & payroll processing fees</option>
                            </select>
                            <select class="w3-input" name="ledger" id="ledger-id-revenue" style="display: none;">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="PRODUCT">Product sales revenue</option>
                                <option value="SERVICES_SALES">Services sales</option>
                                <option value="COMMISSION_EARNED">Commissions earned</option>
                                <option value="INTEREST_EARNED">Interest earned revenue</option>
                                <option value="SERVICE_REVENUE">Service revenue</option>
                                <option value="UNEARNED_REVENUE">Unearned revenue</option>
                                <option value="SALES">Sales</option>
                            </select>
                            <br>
                            <input class="w3-input" type="date" name="date-journal" id="date-input"><br>
                            <textarea class="w3-input" name="description" id="description-id" cols="10" rows="2"></textarea><br>
                            <input style="width: 70%;" class="w3-input" type="number" id="debit-id" name="debit"><br>                            
                            <input style="width: 70%; display: none;" class="w3-input" type="number" id="credit-id" name="credit">
                            <br>
                            <button id="btn-expense" class="w3-button w3-white w3-round-xxlarge" onclick="addJournalExpense();" style="float: right;">Save Expense</button>
                            <button id="btn-revenue" class="w3-button w3-white w3-round-xxlarge" onclick="addJournalRevenue();" style="float: right; display: none;">Save Revenue</button>
                        </div>
                    </div>
                </div>
                <!-- End of accounting page workspace -->
            </div>
        </div>
    </section>
<!-- Start of javascript section -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    checkSession();
    getSession();
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
            $("#logo_cem_name").html(obj.cemetery_name + " / Journal Entry");
            $("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        }
    });
  }

  //Change the input field of expense and revenue
  function changeSelect(){
    var transaction = $("#transaction-id").val();
    if(transaction == 'REVENUE'){
        document.getElementById('ledger-id-revenue').style.display = 'block';
        document.getElementById('ledger-id-expense').style.display = 'none';
        document.getElementById('credit-id').style.display = 'block';
        document.getElementById('debit-id').style.display = 'none';
        document.getElementById('label-credit').style.display = 'block';
        document.getElementById('label-debit').style.display = 'none';

        document.getElementById('btn-expense').style.display = 'none';
        document.getElementById('btn-revenue').style.display = 'block';
    }else{
        document.getElementById('ledger-id-revenue').style.display = 'none';
        document.getElementById('ledger-id-expense').style.display = 'block';
        document.getElementById('debit-id').style.display = 'block';
        document.getElementById('credit-id').style.display = 'none';
        document.getElementById('label-debit').style.display = 'block';
        document.getElementById('label-credit').style.display = 'none';

        document.getElementById('btn-expense').style.display = 'block';
        document.getElementById('btn-revenue').style.display = 'none';
    }
  }

  //Function to submit journal to database
  //Find if the date does not exist first before inserting a new financial report
  function addJournalExpense(){
    var transaction = $("#transaction-id").val();
    var ledge = $("#ledger-id-expense").val();
    var date_journal = $("#date-input").val();
    var desc = $("#description-id").val();
    var debit_amount = $("#debit-id").val();

    $.ajax({
        type: 'post',
        url: 'includes/functionInsertJournal.php',
        data:{
            account: transaction,
            ledger: ledge,
            date: date_journal,
            description: desc,
            debit: debit_amount
        },
        success:function(result, status){
            alert(result);
            $("#transaction-id").val('');
            $("#ledger-id-expense").val('');
            $("#date-input").val('');
            $("#description-id").val('');
            $("#debit-id").val('');
        }
    });
  }

  function addJournalRevenue(){
    var transaction = $("#transaction-id").val();
    var ledge = $("#ledger-id-revenue").val();
    var date_journal = $("#date-input").val();
    var desc = $("#description-id").val();
    var credit_amount = $("#credit-id").val();
    
    $.ajax({
        type: 'post',
        url: 'includes/functionInsertJournal.php',
        data:{
            account: transaction,
            ledger: ledge,
            date: date_journal,
            description: desc,
            credit: credit_amount
        },
        success:function(result, status){
            alert(result);
            $("#transaction-id").val('');
            $("#ledger-id-revenue").val('');
            $("#date-input").val('');
            $("#description-id").val('');
            $("#credit-id").val('');
        }
    });
  }

</script>
<!-- End of javascript section -->
</body>
</html>