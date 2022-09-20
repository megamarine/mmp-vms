<?php
$PERUSAHAN_USER = $_SESSION["LOGINPER_VISITOR"];
$where_clause = "";
$NAMA_TYPE    = "";
$VISITOR_TYPE = "";

if (isset($_POST["cari"])) 
{
    $PERIODE      = $_POST["PERIODE"];
    $PERIODE2     = $_POST["PERIODE2"];
    if (isset($_POST["VISITOR_TYPE"]) and ($_POST["VISITOR_TYPE"] != '' ))
    {
        $VISITOR_TYPE = $_POST["VISITOR_TYPE"];
        $where_clause = "and vr.visitor_type = '$VISITOR_TYPE'";
        $stmt = GetQuery("select name from m_visitor_type where id = '$VISITOR_TYPE'");
        while ($rowz = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $NAMA_TYPE   = " - ".$rowz["name"];
        }
    }
}
else
{
    $PERIODE    = date("Y-m-d");
    $PERIODE2   = date("Y-m-d");
}

$stmt = GetQuery("
        select vr.*, 
               case status_visitor
                 when '1' then 'Check In'
                 else 'Check Out'
               end as status_visit, 
               mc.company_name as company,
               mp.description as purpose,
               mv.name as vtype
          from vims_reg as vr
     LEFT JOIN m_company mc ON vr.company_id = mc.company_id
     LEFT JOIN m_purpose mp ON vr.purpose_id = mp.purpose_id
     LEFT JOIN m_visitor_type as mv ON vr.visitor_type = mv.id
        where  STR_TO_DATE(checkin_date, '%Y-%m-%d') between '$PERIODE' and '$PERIODE2' and
               vr.plant_id = '$PERUSAHAN_USER'
               $where_clause
      order by vm_no desc");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> Laporan Visitor <?php echo $NAMA_TYPE; ?></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> Laporan Visitor</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <form role="form" action="" method="post">
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Awal</label>
                <input type="text" class="form-control" name="PERIODE" id="datepicker1" value="<?php echo $PERIODE; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Akhir</label>
                <input type="text" class="form-control" name="PERIODE2" id="datepicker2" value="<?php echo $PERIODE2; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="VISITOR_TYPE" style="font-size: 15px;">Type Visitor</label>
                <select name="VISITOR_TYPE" id="VISITOR_TYPE" class="form-control">
                    <option style="background: #74777a; color: #fff;" value="">-- Pilih Type Visitor --</option>
                    <?php
                    $stmj = GetQuery("select * from m_visitor_type order by name asc");
                    while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <option value="<?php echo $rowz["id"]; ?>"
                            <?php 
                                if($VISITOR_TYPE == $rowz["id"]) 
                                { 
                                    echo "selected"; 
                                } 
                            ?>>
                            <?php 
                                echo $rowz["name"]; 
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label style="color: transparent;">.</label><br>
            <button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search-plus fa-lg"></i> Cari</button>&nbsp&nbsp&nbsp
            <a href="laporan_visitor" type="button" class="btn btn-danger"><i class="fa fa-refresh fa-lg"></i> Clear</a>
        </div>   
    </form>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12" align="right">
                <?php
                if (isset($_POST["VISITOR_TYPE"]) and ($_POST["VISITOR_TYPE"] != '' ))
                {
                ?>
                    <a href="print_laporanvisitor?TYPE=<?php echo $VISITOR_TYPE;?>&PERIODE=<?php echo $PERIODE; ?>&PERIODE2=<?php echo $PERIODE2; ?>" type="button" target="_blank" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Cetak</a>
                <?php            
                }
                else
                {
                ?>
                    <a href="print_laporanvisitor?PERIODE=<?php echo $PERIODE; ?>&PERIODE2=<?php echo $PERIODE2; ?>" type="button" target="_blank" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Cetak</a>
                <?php
                }
                ?>
                
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan Visitor</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Tamu</th>
                        <th>Status</th>
                        <th>Nama Visitor</th>
                        <th>Asal</th>
                        <th>Tipe Visitor</th>
                        <th>Keperluan</th>
                        <th>PIC</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Total Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $DINO   = date("Y-m-d H:i:s");

                        $TANGGAL         = DATE_CREATE($row["checkin_date"]);
                        $TANGGAL2        = DATE_CREATE($row["checkout_date"]);
                        $TANGGAL_MASUK   = DATE_FORMAT($TANGGAL, 'd/m/Y');
                        $JAM_MASUK       = DATE_FORMAT($TANGGAL, 'H:i:s');
                        $TANGGAL_KELUAR  = DATE_FORMAT($TANGGAL2, 'd/m/Y');
                        $JAM_KELUAR      = DATE_FORMAT($TANGGAL2, 'H:i:s');

                        $KODE_TAMU       = $row["vm_no"];

//-----------------------------------BELUM KELUAR---------------------------------------------------------//
                        $datetime1  = new DateTime($row["checkin_date"]);
                        $datetime2  = new DateTime($DINO);
                        $interval   = $datetime1->diff($datetime2);

                        $date1      = new DateTime($row["checkin_date"]);
                        $date2      = new DateTime($DINO);
                        $DATEZ      = $date2->diff($date1)->format('%a');

//-----------------------------------SUDAH KELUAR---------------------------------------------------------//
                        $datetimex  = new DateTime($row["checkin_date"]);
                        $datetimey  = new DateTime($row["checkout_date"]);
                        $intervalx  = $datetimey->diff($datetimex);

                        $datex      = new DateTime($row["checkin_date"]);
                        $datey      = new DateTime($row["checkout_date"]);
                        $DATEX      = $datex->diff($datey)->format('%a'); 
//--------------------------------------------------------------------------------------------------------//
                        ?>
                        <tr>
                            <td align="center"><?php echo $no++; ?></a></td>
                            <td align="left"><?php echo $row["vm_no"]; ?></a></td>
                            <td align="left"><?php echo ucwords(strtolower($row["status_visit"])); ?></td>

                            <td align="left"><?php echo ucwords(strtolower($row["visitor_name"])); ?></td>

                            <td align="left"><?php echo ucwords(strtolower($row["company"])); ?></td>
                            <td align="left"><?php echo ucwords(strtolower($row["vtype"])); ?></td>
                            <td align="left"><?php echo ucwords(strtolower($row["purpose"])); ?></td>
                            <td align="left"><?php echo ucwords(strtolower($row["pic"])); ?></td>
                            <td align="center"><?php echo $TANGGAL_MASUK;?> <br/> 
                                                  <?php echo $JAM_MASUK; ?></td>
                            <?php 
                            if (is_null($row["checkout_date"]))
                            {
                            ?>
                               <td style="color:red" align="center"><i class="fa fa-power-off fa-lg"></i></td>
                               <td style="color:red" align="center"><?php echo $DATEZ . " Hari " . $interval->format('%h')." Jam ".$interval->format('%i')." Menit"; ?><br/></td>  
                            <?php 
                            }
                            else
                            {
                            ?>
                            <td align="center"><?php echo $TANGGAL_KELUAR;?> <br/> 
                                                  <?php echo $JAM_KELUAR; ?></td>
                            <td align="left"><?php echo $DATEX . " Hari " . $intervalx->format('%h')." Jam ".$intervalx->format('%i')." Menit"; ?></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function(){
        // Find any date inputs and override their functionality
        $('#datepicker1').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>