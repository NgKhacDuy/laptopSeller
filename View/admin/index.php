<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include ("../../helpers/format.php");

?>
<?php include '../../Model/admin/bill.php'?>
<?php include '../../Model/admin/admin.php'?>
<?php include '../../Model/admin/thongke.php'?>
<?php
    $thongke = new thongke();
?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thông Tin</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Thành Viên</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php 
                $admin=new admin();
                $quantityAdmin=$admin->get_quantity_admin();
                while($data=mysqli_fetch_array($quantityAdmin)){


               ?>
               <h4>Số Lượng Admin: <?php echo $data['admin_User'] ?> </h4>
              <?php } ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh Thu</div>
              <?php 
                $fm = new Format();
                $bill = new bill();
                $gettotal = $bill->totalprice();
                if($gettotal){
                  while ($result = $gettotal->fetch_assoc()) {
                   

                  ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo $fm->format_currency($result['total']) ?></div>
              <?php 
                  }
                }

               ?>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số lượng bán ra</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">30</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  style="color: #F6C23E" href="listbill.php">Số Lượng Đơn</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <?php 
                
                $pending =$bill->getPending();
                if($pending){
                  while ($result = $pending->fetch_assoc()) {
                  
                  ?>
                  <?php echo $result['status'] ?>
                  
                  <?php 

                  }
                }
                ?>

               </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="chart-container" style="">
    <div class="chart-monthly" style="">
        <h2 style="text-align:center;">Thống kê hàng tháng</h2>
        <canvas id="chartMonthly"></canvas>
    </div>
    <div class="chart-category">
        <h2 style="text-align:center;">Loại sản phẩm</h2>
        <canvas id="myChart"></canvas>
    </div>
    
</div>
<script>
  const ctx = document.getElementById('myChart');
  const chartMonthly = document.getElementById('chartMonthly');
  const chartData = {
    labels:[
        <?php
            $show = $thongke->getAllTotalByCategory();
            if($show){
                while($result = $show->fetch_assoc()){
                     echo '"'.$result['TenLoaiSP'].'",';
                }
            }
        ?>
    ],
    data: [
        <?php
            $show = $thongke->getAllTotalByCategory();
            if($show){
                while($result = $show->fetch_assoc()){
                     echo $result['totalMoney'].',';
                }
            }
        ?>
    ]
  }
  
const labelMonthly = [
    <?php
            $show = $thongke->getMonthlyTotal();
            if($show){
                while($result = $show->fetch_assoc()){
                    $dateObj = DateTime::createFromFormat('!m', $result['month']);
                    $monthName = $dateObj->format('F');
                    echo '"'.$monthName.'",';
                }
            }
        ?>
];
const dataMonthly = {
labels: labelMonthly,
datasets: [{
    label: 'Doanh thu theo tháng',
    data: [
        <?php
            $show = $thongke->getMonthlyTotal();
            if($show){
                while($result = $show->fetch_assoc()){
                     echo $result['totalMoney'].',';
                }
            }
        ?>
    ],
    backgroundColor: [
    'rgba(255, 99, 132, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 205, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
    'rgb(75, 192, 192)',
    ],
    // borderWidth: 1,
    fill: false,
    tension: 0.1
}]
};
new Chart(chartMonthly,{
    type: 'line',
    data:dataMonthly,
    options:{
      responsive:true
    }
  });
  new Chart(ctx, {
    type: 'doughnut',
    data:{
        labels: chartData.labels,
        datasets:[
            {
                label: "Tổng giá đã bán",
                data: chartData.data,
            }
        ]
    },
    options:{
      responsive:true
    },
  });
  
</script>







  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>