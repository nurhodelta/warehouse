<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="page">
    <div class="page-title blue">
        <h3>
            <?php echo $breadcrumb; ?>
        </h3>
        <p>Information About
            <?php echo $breadcrumb; ?>
        </p>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel rounded-0">
                    <div class="panel-heading">
                        <h5 class="panel-title">View Data
                            <?php echo $breadcrumb; ?>

                            <select style="float:right" id="good_select">
                                <option value="" <?php if ($sel_good == null) { echo 'selected'; } ?>>All</option>
                                <?php
                                    foreach($goods as $good) {
                                        ?>
                                         <option value="<?php echo $good->id_barang ?>" <?php if ($sel_good == $good->id_barang) { echo 'selected'; } ?>><?php echo $good->nama_barang ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </h5>
                    </div>
                    <!-- ========== Flashdata ========== -->
                    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                    <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check sign"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } else if ($this->session->flashdata('warning')) { ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check sign"></i>
                        <?php echo $this->session->flashdata('warning'); ?>
                    </div>
                    <?php } else { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-warning sign"></i>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <!-- ========== End Flashdata ========== -->
                    <div class="panel-body container-fluid table-detail">
                    <script src="<?php echo base_url();?>templates/backend/js/highchart.js"></script>
					<script src="<?php echo base_url();?>templates/backend/js/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>

    $('#good_select').change(function(){
        var sel_good = $(this).val();
        location.href = '<?php echo base_url(); ?>website/incoming-forecast?sel_good='+sel_good;
    });

	Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Incoming Goods Forecast'
    },
    subtitle: {
        text: 'Incoming Forecast Stats'
    },
    xAxis: {
        categories: [
			'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Number of Incoming Goods Forecast (pcs)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} pcs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Forecast Data',
            data: [
                <?php 
                foreach ($forecast as $data){ ?>
                    <?php echo $data;?>,
                <?php } ?>
            ]
        },
        {
            name: 'Goods Data',
            data: [
                <?php 
                foreach ($good_data as $gdata){ ?>
                    <?php echo $gdata;?>,
                <?php } ?>
            ]
        },
    ]
});
</script>

                    </div>
						
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>