@extends('admin.layout.backEnd')

@section('activities')
    <div id="content-wrapper">

        <div class="container-fluid">


            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Activities</div>

                <div class="card-body">
                    <input type="date" name="filter_date" id="filter_date" style="margin-bottom: 20px;" onchange="date()"/>
                    <div class="table-responsive" id="all_days">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Activities</th>
                            </tr>
                            </thead>

                            @foreach($activities as $action)
                                <tbody>
                                <td>{{$action->date}}</td>
                                <td>{{$action->text}}</td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div id="filter_days" style="display: none;">

                    </div>
                </div>
            </div>
                {{$activities->links()}}

        </div>
        <!-- /.container-fluid -->

    </div>
    @endsection

@section('back_script')
    @parent
    <script type="text/javascript">

        function date() {


            var date_value = $('#filter_date').val();


            $.ajax({

                type:'GET',
                url:'/activities/sort',
                data:{
                    date:date_value
                },
                dataType:'json',
                success:function (data) {

                    var ispis = "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">\n" +
                        "                            <thead>\n" +
                        "                            <tr>\n" +
                        "                                <th>Date</th>\n" +
                        "                                <th>ActivityController</th>\n" +
                        "                            </tr>\n" +
                        "                            </thead>";

                    for(var i in data){

                        ispis += "<tbody>";
                        ispis += "<td>"+data[i].date+"</td>";
                        ispis += "<td>"+data[i].text+"</td>";
                        ispis += "</tbody>";
                    }
                    ispis +='</table>';


                    $('#all_days').hide();
                    $('#filter_days').html(ispis);
                    $('#filter_days').show();
                },
                error:function (xhr,Status,ErrMsg) {

                }
            });
        }

    </script>
    @endsection
