<?php 
include './includes/config.php';

$sql = "SELECT * FROM business_applicant";
$pdo = Database::connection();
$stmt = $pdo->prepare($sql);


$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 
        $subarray = [
            "<td>" . $row['pos_vacant'] . "</td>",
            "<td><button type='button' class='btn btn-warning btn-sm' onclick=editJob(".$row['bus_applicant'].",'".str_replace(' ','_',$row['pos_vacant'])."','".str_replace(' ','_',$row['job_desc'])."','".str_replace(' ','_',$row['job_spec'])."','".str_replace(' ','_',$row['degree'])."','".str_replace(' ','_',$row['year_exp'])."')>
            <i class='bx bx-show-alt'></i>
            </button>
            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Cancel'>
                                  <i class='bx bx-x-circle'></i>
                                </button></td>",
        ];
        $data[] = $subarray;
    }
}


$output = [
    'data' => $data,
];

echo json_encode($output);
?>