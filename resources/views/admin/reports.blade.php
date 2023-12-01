@extends('layouts.master')

@section('title')
DASHBOARD
@endsection

@section('pagetitle')
   REPORTS
@endsection

@section('css')

@endsection

@section('content')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="title">REPORTS (S.Y. {{$year->year}})</h4>
                        </div>

	                    <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-content">
                                    <form action="/reports/mortality" method="POST" target="_blank">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Print PDF</button>
                                    </form>
                                    <div id="mortality"></div>
                                    
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-content">
                                    <form action="/reports/risk" method="POST" target="_blank">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Print PDF</button>
                                    </form>
                                    <div id="risktaker"></div>
                                    
	                            </div>
	                        </div>
	                    </div>
                        
	                    <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-content">
                                    <form action="/reports/studentYear" method="POST" target="_blank">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Print PDF</button>
                                    </form>
                                    <div id="students"></div>
                                    
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-content">
                                    <form action="/reports/demographics" method="POST" target="_blank">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Print PDF</button>
                                    </form>
                                    <div id="gender"></div>
                                    
	                            </div>
	                        </div>
	                    </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" ><b>EARLY REGISTRATION REPORTS</b></h4>
                                    <p class="category">Filtered depending on the quota that was set per strand.</p>
                       
                                </div>
                                    <div class="row">
										<div class="col-lg-6">
                                            <div class="card-content">
												<h4 class="card-title" style="margin-bottom: 0;"><b>Academic Track</b></h4>
                                                <div class="card-content table-responsive table-full-width">
	                                                <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Accountancy, Business and Management</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/abm" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>General Academic</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/gas" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Humanities and Social Sciences</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/humss" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Science, Technology, Engineering And Mathematics</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/stem" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                        </tbody>
                                                    </table>
                                                </div>
											</div>
                                        </div>

                                        <div class="col-lg-6">
											<div class="card-content">
                                                <h4 class="card-title" style="margin-bottom: 0;"><b>Technical-Vocational Livelihood Track</b></h4>
                                                <div class="card-content table-responsive table-full-width">
	                                                <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Caregiving (Nursing Arts)</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/care" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Electrical Installation And Maintenance</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/eim" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Home Economics</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/he" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                                <br>
                                                            <tr>
                                                                <div style="display: inline-block; padding-right:10px">
                                                                    <h5 class="card-title"><b>Information And Communications Technology</b></h5>
                                                                </div>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/ict" method="POST" target="_blank">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>
                                                            <tr>
                                                        </tbody>
                                                    </table>
                                                </div>
											</div>
                                        </div>
										
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="card-content">
												<h4 class="card-title" style="margin-bottom: 0;"><b>Print Graduates</b></h4>
                                                <div class="card-content table-responsive table-full-width">
	                                                <table class="table">
                                                        <tbody>
                                                            <tr>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/graduates" method="POST" target="_blank">
                                                                        @csrf
                                                                        <div style="display: inline-block; padding-right:10px">
                                                                            <h5 class="card-title"><b> Select School Year</b></h5>
                                                                            {!! Form::select('year', $yearOptions, null, ['placeholder' => 'Select School Year', 'class' => 'form-control', 'required' => 'required']) !!}
                                                                        </div>
                                                                        
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>

                                                            <tr>
                                                        </tbody>
                                                    </table>
                                                </div>
											</div>
                                        </div>


 
                                        <div class="col-lg-6">
                                            <div class="card-content">
                                                <h4 class="card-title" style="margin-bottom: 0;"><b>Print Interview Reports</b></h4>
                                                <div class="card-content table-responsive table-full-width">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>

                                                                <div style="display: inline-block;">
                                                                    <form action="/reports/interview" method="POST" target="_blank">
                                                                        @csrf
                                                                        <div style="display: inline-block; padding-right:10px">
                                                                            <h5 class="card-title"><b> Intervew Report</b></h5>
                                                                        </div>
                                                                        
                                                                        <button type="submit" class="btn btn-sm btn-success">Print</button>
                                                                    </form>
                                                                </div>

                                                            <tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                        </div>


	                </div>
	            </div> 

@endsection

@section('script')  

    <!-- FOR CHARTS -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <script type="text/javascript">
        //  FOR MORTALITY CHART ------------------------------------------------------------------------------------------------------------------------------------------------
        var data = <?php echo json_encode($mortality)?>;
        var series = [];
        var sy = <?php echo json_encode($year->year)?>;
        
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                series.push({
                    name: key,
                    data: data[key]
                });
            }
        }

        Highcharts.chart('mortality', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Absences Count per Month ' + sy
            },
            subtitle: {
                text: 'SHAM: Student Access Module'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                    'Oct', 'Nov', 'Dec'   
                ]
            },
            yAxis: {
                title: {
                    text: 'Total Absences'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: series,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });


        var students = <?php echo json_encode($students)?>;
        var series = [];
        var years = <?php echo json_encode($years)?>;
        
        for (var key in students) {
            if (students.hasOwnProperty(key)) {
                series.push({
                    name: key,
                    data: students[key]
                });
            }
        }

        Highcharts.chart('students', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Students Count '
            },
            subtitle: {
                text: 'SHAM: Student Access Module'
            },
            xAxis: {
                categories: years
            },
            yAxis: {
                title: {
                    text: 'Total Students'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: series,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });


        // FOR AT GENDER ------------------------------------------------------------------------------------------------------------------------------------------------
        var male = <?php echo json_encode($male)?>;
        var female = <?php echo json_encode($female)?>;
        Highcharts.chart('gender', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Student Gender ' + sy
            },
            subtitle: {
                text: 'SHAM: Student Access Module'
            },
            xAxis: {
                categories: ['ABM', 'GAS', 'HUMSS', 'STEM', 'CARE', 'EIM', 'HE', 'ICT'
                ]
            },
            yAxis: {
                title: {
                    text: 'Total Students'
                }
            },

            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                },
            },
            series: [{
                    name: 'male',
                    data: male

                }, {
                    name: 'female',
                    data: female

                },],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // FOR AT RISK CHART ------------------------------------------------------------------------------------------------------------------------------------------------
        var drill = <?php echo json_encode($drill)?>;
        var version = <?php echo json_encode($version)?>;

        var browserData = drill.map(browser => ({
            name: browser.name,
            y: browser.num,
            drilldown: browser.name
        }));

        const drilldownSeries = [];
        const browsers = ['ABM', 'GAS', 'HUMSS', 'STEM', 'CARE', 'EIM', 'HE', 'ICT'];

        console.log(version);
        for (const browser of browsers) {
            // console.log(browser);
            var browserVersions = version.filter(item => item.browser === browser);
            var versionDataArray = browserVersions.map(item => [item.section, item.num]);

            drilldownSeries.push({
                name: browser,
                id: browser,
                data: versionDataArray
            });
        }
        
        Highcharts.chart('risktaker', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'center',
            text: 'Student At Risk ' + sy
        },
        subtitle: {
            text: 'SHAM: Student Access Module'
        },
        accessibility: {
            announceNewData: {
            enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
            text: 'Total Students'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
        },

        series: [
            {
            name: 'Strands',
            colorByPoint: true,
            data: browserData
            }
        ],
        drilldown: {
            breadcrumbs: {
            position: {
                align: 'right'
            }
            },
            series: drilldownSeries
        }
        });
    </script>
@endsection


