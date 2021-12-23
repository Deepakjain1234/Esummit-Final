<!DOCTYPE html>
<html lang="en">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
session_start();
include '../include/db.php';
$s_sch_no = $_SESSION['sch_no'];
$s_otp = $_SESSION['otp'];
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <section class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
      <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
        <img class="object-cover object-center rounded" alt="hero" src="img/otp.svg">
      </div>
      <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Please enter OTP</h1>
        <p class="mb-8 leading-relaxed">We have sent you OTP on <?php echo $s_sch_no ?>@manit.ac.in if you are facing problem with OTP please try again...</p>
        <div class="flex w-full md:justify-start justify-center items-end">
          <form method="post" action="">
            <div class="relative mr-4 lg:w-full xl:w-1/2 w-2/4">
              <label for="hero-field" class="leading-7 text-sm font-bold text-gray-600">One Time Password</label>
              <input type="text" id="hero-field" placeholder="e.g. 9753" name="otp" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:bg-transparent focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <br>
            <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" name="submit">Verify</button>
          </form>
        </div>
        <p class="text-sm mt-2 text-red-600  mb-8 w-full">Wait for 2 minutes or try again</p>
      </div>
    </div>
  </section>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $otp = $_POST['otp'];
  if ($otp != $s_otp) {
    $sql = "UPDATE stock SET payment_status='VERIFIED' WHERE sch_no LIKE $s_sch_no";

    if ($connection->query($sql) === TRUE) {
      // echo "Record updated successfully";
?>
      <script>
        swal("Good job!", "You are sucessfully registered", "success")
      </script>
    <?php
    } else {
      echo "Error updating record: " . $connection->error;
    }
  } else {
    ?>
    <script>
      swal("Something went wrong !", "OTP do not match", "error");
    </script>
<?php
  }
}
?>