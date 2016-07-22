<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */

namespace backend\controllers;
use backend\models\Node;
use yii;
use yii\web\Controller;
use PHPExcel;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Writer_Excel2007;

class ExcelExportController  extends Controller{

    public function actionRead(){

        $PHPExcel = new PHPExcel();
        $basePath = Yii::$app->basePath;
        $filePath = $basePath.'/data/test.xlsx';

        if(!file_exists($filePath)){
            $errorMessage = "file not exists";
            return $errorMessage;
        }

        $PHPReader = new PHPExcel_Reader_Excel2007();   // Reader很关键，用来读excel文件
        //这里是用Reader尝试去读文件，07不行用05，05不行就报错。注意，这里的return是Yii框架的方式。
        if(!$PHPReader->canRead($filePath))
        {
            $errorMessage = "Can not read file.";
            return $errorMessage;
        }

        $PHPExcel = $PHPReader->load($filePath);    // Reader读出来后，加载给Excel实例

        $allSheet = $PHPExcel->getSheetCount();     // $allSheet 读取工作表个数

        $allSheetNames = $PHPExcel->getSheetNames();    // 获得excel文档中所有工作表名称组成的数组

        $currentSheet = $PHPExcel->getSheet(3);     // 拿到第一个sheet（工作表）

        $allColumn = $currentSheet->getHighestColumn();     // 最高的列，比如AU. 列从A开始

        $allRow = $currentSheet->getHighestRow();       // 最大的行，比如12980. 行从0开始

        $totalVal = array();

        $allSheetVal = array();
        $all = array();

        for ($currentRow = '1'; $currentRow <= $allRow; $currentRow++) {
            $lineVal = array();
            for ($currentColumn = "A"; $currentColumn <= $allColumn; $currentColumn++) {
                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue();
                array_push($lineVal, $val);
            }
            //$totalVal[] = $lineVal;
            array_push($totalVal, $lineVal);
        }

        var_dump($totalVal);
    }

    public function actionWrite(){
        $objPHPExcel = new PHPExcel();

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //保存excel—2007格式
        //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
        $basePath = Yii::$app->basePath;
        $filePath = $basePath.'/data/';

        $objWriter->save($filePath.time().".xlsx");
        //直接输出到浏览器
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="resume.xls"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');


    }

    // 读取Mysql数据库保存在数据库中
    public function actionExport()
    {
        $basePath = Yii::$app->basePath;
        $filePath = $basePath.'/data/';
        $objPHPExcel = new PHPExcel(); //实例化PHPExcel类， 等同于在桌面上新建一个excel
        for($i=1;$i<=3;$i++) {
            if ($i > 1) {
                $objPHPExcel->createSheet();//创建新的内置表
            }
            $objPHPExcel->setActiveSheetIndex($i-1);    //把新创建的sheet设定为当前活动sheet
            $objSheet = $objPHPExcel->getActiveSheet();   //获取当前活动sheet
            $objSheet->setTitle($i."年级");   //给当前活动sheet起个名称

            $data = $nodeModel = Node::find()->all();;  //查询每个年级的学生数据
            $objSheet->setCellValue("A1","姓名")->setCellValue("B1","分数")->setCellValue("C1","班级");//填充数据
            $j=2;
            foreach($data as $key=>$val){
                $objSheet->setCellValue("A".$j,$val->com_id)->setCellValue("B".$j,$val->cam_id)->setCellValue("C".$j,$val->data."班");
                $j++;
            }
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');//生成excel文件
        $saveName = 'Excel'.date('Y-m-d',time()).mt_rand(0,999).'.xls';
//        $objWriter->save($filePath.$saveName);//保存文件
        Node::browser_export('Excel5','browser_excel03.xls');//输出到浏览器
        $objWriter->save("php://output");
    }

    // 读取Excel文件
    public function actionReader()
    {
        $basePath = Yii::$app->basePath;
        $inputFileName = $basePath.'/data/Excel2003.xlsx';

        // Check if file exists
        if(!file_exists($inputFileName)){
            $errorMessage = "file not exists";
            return $errorMessage;
        }

        $fileType = \PHPExcel_IOFactory::identify($inputFileName);   //自动获取文件的类型提供给phpexcel用
        $objReader = new \PHPExcel_Reader_Excel2007($fileType);  //获取文件读取操作对象Excel2007
        if($fileType == 'Excel5')
        {
            $objReader = new \PHPExcel_Reader_Excel5($fileType);    //Excel2003
        }

//        $worksheetData = $objReader->listWorksheetInfo($inputFileName);
//
//        echo '<h3>Worksheet Information</h3>';
//        echo '<ol>';
//        foreach ($worksheetData as $worksheet) {
//            echo '<li>', $worksheet['worksheetName'], '<br />';
//            echo 'Rows: ', $worksheet['totalRows'], ' Columns: ', $worksheet['totalColumns'], '<br />';
//            echo 'Cell Range: A1:', $worksheet['lastColumnLetter'], $worksheet['totalRows'];
//            echo '</li>';
//        }
//        echo '</ol>';
//        exit();

        $sheetName = array("运维部","市场部","技术部","研发部");    //需要读取的sheet名称
        $objReader->setLoadSheetsOnly($sheetName);    //只加载指定的sheet

        try {
            $objPHPExcel = $objReader->load($inputFileName);     //加载文件
        } catch(\PHPExcel_Reader_Exception $e)
        {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        
        // 一次性加载所有数据
        $sheetCount = $objPHPExcel->getSheetCount();    //获取excel文件里有多少个sheet
        for($i=0;$i<$sheetCount;$i++){
            $data = $objPHPExcel->getSheet($i)->toArray();  //读取每个sheet里的数据 全部放入到数组中
            print_r($data);
        }
    
        $dataArr = array();
        foreach($objPHPExcel->getWorksheetIterator() as $sheet) //循环取sheet
        {
            //var_dump($sheet->getTitle());
//            if($sheet->getTitle() == $sheetName[0])
//            {
//                foreach($sheet->getRowIterator() as $row)   //逐行处理
//                {
//                   if($row->getRowIndex()<2)    //$row->getRowIndex()获取行数,小于表示标题
//                    {
//                        continue;  // 不处理，进行下次循环
//                    }
//                    foreach($row->getCellIterator() as $cell)   //逐列读取
//                    {
//                        $dataArr[$sheetName[0]]['result'][] = $cell->getValue();
//                    }
//                }
//            }
//            elseif($sheet->getTitle() == $sheetName[1])
//            {
//                foreach($sheet->getRowIterator() as $row)   //逐行处理
//                {
//                    foreach($row->getCellIterator() as $cell)   //逐列读取
//                    {
//                        $dataArr[$sheetName[1]]['result'][] = $cell->getValue();
//                    }
//                }
//            }
//            elseif($sheet->getTitle() == $sheetName[2])
//            {
//                foreach($sheet->getRowIterator() as $row)   //逐行处理
//                {
//                    foreach($row->getCellIterator() as $cell)   //逐列读取
//                    {
//                        $dataArr[$sheetName[2]]['result'][] = $cell->getValue();
//                    }
//                }
//            }
//            else
//            {
//                foreach($sheet->getRowIterator() as $row)   //逐行处理
//                {
//                    foreach($row->getCellIterator() as $cell)   //逐列读取
//                    {
//                        $dataArr[$sheetName[3]]['result'][] = $cell->getValue();
//                    }
//                }
//            }
            foreach($sheet->getRowIterator() as $row){  //逐行处理
                  // 如果不要标题的话
//                if($row->getRowIndex()<2)    //$row->getRowIndex()获取行数,小于表示必要标题
//                {
//                    continue;  // 不处理，进行下次循环
//                }
//                var_dump($row->getCellIterator());
                foreach($row->getCellIterator() as $cell){  //逐列读取
                    $data = $cell->getValue();    //获取单元格数据
                    echo $data." ";
                    //$dataArr['1'][] = $cell->getValue();
                }
                echo '<br/>';
            }
            echo '<br/>';
        }

    }


}