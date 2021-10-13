<?php
require_once 'student.php';
?>
<html lang="en" style="background-color: aquamarine;">
<?php include('./template/header.php') ?>

<body>
    <title>Student Info</title>
    <h3>List of student</h3>
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
                                        <td><?php echo $stu->getName() ?></td>
                                        <td><?php echo $stu->getID() ?></td>
                                        <td><?php echo $stu->getPhone() ?></td>
                                        <td><?php if ($stu->getRole() == 0) {
                                                echo "Student";
                                            } else {
                                                echo "Teacher";
                                            }
                                            ?></td>
                                        <td><a href="controller/info.php?studentID=<?php echo $stu->getID() ?>">Detail</a></td>
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
