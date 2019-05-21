<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015-07-09
 * Time: 17:06
 */
class ExportExcel {
    public function  createExcel($data,$title,$name)
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.PHPExcel");
        import("Org.PHPExcel.Writer.Excel5");
        import("Org.PHPExcel.IOFactory.php");
        $objPHPExcel = new \PHPExcel();
        //判断数据的条数  超过一百条就分sheet
        $count = count($data);
        $arr_tmp = [];
        //将$data按五千一个切分到$arr_tmp;
        for($i=0;$i<$count;$i+=5000){
            $arr_tmp[] = array_slice($data,$i,5000);
        }
        $c = count($arr_tmp);
        for($j=0;$j<$c;$j++){
            if($j!=0){
                //创建一个新的工作空间(sheet)
                $objPHPExcel->createSheet();
            }
            $objPHPExcel->setActiveSheetIndex($j);
            $objActSheet[$j] = $objPHPExcel->getActiveSheet();
            $key = ord("A");
            foreach($title as $v){
                $colum = chr($key);
                $cellIndex = $colum.'1' ;
                $objActSheet[$j]->setCellValue($cellIndex, $v);
//                $objActSheet[$j]->getStyle($cellIndex)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//                    ->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
                $key += 1;
            }
            $rowsIndex = 0;
            $column = 2;
            foreach($arr_tmp[$j] as  $rows){ //行写入
                if($rows[$name[0]]!=''){
                    $rowsIndex++;
                }
                if($rowsIndex%2 == 0){
                    $colo = 'FFF4F4F4';
                }else{
                    $colo = 'FFFFE4C4';
                }

                $span = ord("A");
                for($i=0;$i<count($name);$i++){// 列写入
                    $k = chr($span);
                    $cellIndex = $k.$column ;
                    $objActSheet[$j]->setCellValueExplicit($cellIndex , $rows[$name[$i]],PHPExcel_Cell_DataType::TYPE_STRING);
                    $span++;
                }
                $column++;
            }
        }
        //保存excel—2007格式
//        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//        $objWriter->save("xxx.xlsx");
        //或者非2007格式
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save("export.xls");
        echo "export.xls";
        //直接输出到浏览器
//
//
//        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//        ob_end_clean();//清除缓冲区,避免乱码
//        header("Pragma: public");
//        header("Expires: 0");
//        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
//        header("Content-Type:application/force-download");
//        header("Content-Type:application/vnd.ms-execl");
//        header("Content-Type:application/octet-stream");
//        header("Content-Type:application/download");
//        header('Content-Disposition:attachment;filename="export.xlsx"');
//        header("Content-Transfer-Encoding:binary");
//        $objWriter->save('php://output');
    }
} 