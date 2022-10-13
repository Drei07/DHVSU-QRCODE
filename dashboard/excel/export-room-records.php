<?php
include_once  __DIR__.'/../../database/dbconfig2.php';

require '../vendor2/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'student-attendance.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$roomId = $_GET["Id"];
$starting_row = 9;

$pdoQuery = "SELECT * FROM student_activity WHERE activity = :activity";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":activity" => $roomId));


while($room_data = $pdoResult->fetch(PDO::FETCH_ASSOC)){

    $student = array($room_data["last_name"], $room_data["first_name"], $room_data["middle_name"]);
    $student_name = $student[0] . ", " . $student[1] . " " . $student[2];


    $sheet = $spreadsheet->getSheetByName('front')
        ->setCellValue('A'.$starting_row, $room_data['employee_name'])
        ->setCellValue('I'.$starting_row, $room_data['studentId'])
        ->setCellValue('K'.$starting_row, $student_name)
        ->setCellValue('S'.$starting_row, $room_data['sex'])
        ->setCellValue('T'.$starting_row, $room_data['birth_date'])
        ->setCellValue('W'.$starting_row, $room_data['age'])
        ->setCellValue('X'.$starting_row, $room_data['religion'])
        ->setCellValue('AB'.$starting_row, $room_data['phone_number'])
        ->setCellValue('AF'.$starting_row, $room_data['email'])
        ->setCellValue('AJ'.$starting_row, $room_data['barangay'])
        ->setCellValue('AO'.$starting_row, $room_data['city'])
        ->setCellValue('AT'.$starting_row, $room_data['province'])
        ->setCellValue('AX'.$starting_row, $room_data['date']);
        

        $starting_row++;

}

$pdoQuery = "SELECT * FROM location WHERE Id = :Id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":Id" => $roomId));
$location = $pdoResult->fetch(PDO::FETCH_ASSOC);


$location_name = $location["location_name"] . " - STUDENTS RECORDS";


$sheet = $spreadsheet->getSheetByName('front')
    ->setCellValue('J3', $location_name)


;


ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$location["location_name"].'-student-attendance-'.date("Y-m-d").'.xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>