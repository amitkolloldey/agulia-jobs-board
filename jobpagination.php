<?php

session_start();

require_once("db.php");

$limit = 12;

if(isset($_GET["page"])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$start_from = ($page-1) * $limit;

$sql = "SELECT * FROM job_post LIMIT $start_from, $limit";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>

                    <div class="attachment-block col-md-12">
                        <div class="attachment">
                            <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading">$<?php echo $row['maximumsalary']; ?>/Month</span></h4>
                            <div class="attachment-text">
                                <div class="job_meta"><p>Posted By:</p> <strong><?php echo $row1['companyname']; ?></strong>
                                    <p>Location:</p> <strong><?php echo $row1['city']; ?> </strong>
                                    <p>Experience:</p> <strong><?php echo $row['experience']; ?> Years</strong>

                                </div>
                            </div>
                        </div>
                    </div>

		<?php
			}
		}
	}
}

$conn->close();