
<?php
require_once 'student.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Dashboard</title></header>";
?>
<html >


<body>
    <title>Student Info</title>
    <h2 style="color: blue;">List of account</h2>
    <table border=1 >
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table border=1 class="table" style="background-color:cornsilk">
                            <thead>
                                <tr>
                                    <th>Full name</th>
                                    <th>Student ID</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $students = Student::getInfo();
                                
                                foreach ($students as $stu) {
                                ?>

                                    <tr>
                                        <td><?php echo $stu->getFullName() ?></td>
                                        <td><?php echo $stu->getID() ?></td>
                                        <td><?php echo $stu->getPhone() ?></td>
                                        <td><?php echo $stu->getMail() ?></td>
                                        <td><?php if ($stu->getRole() == 0) {
                                                echo "Student";
                                            } else {
                                                echo "Teacher";
                                            }
                                            ?></td>
                                        <td><a href="info.php?ID=<?php echo $stu->getID() ?>">Detail</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                    </div>
                </div>
            </div>
        </div>

    </table>
    <a href='./'>Back</a>
    
</body>

</html>
