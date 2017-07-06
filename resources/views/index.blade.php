@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#myfirstchart" data-toggle="tab">Area</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="myfirstchart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>
            </section>

        </div>
        <!-- Main row -->

    </section>
@endsection

@section('func')

    <script>
        var area = new Morris.Area({
            element   : 'myfirstchart',
            resize    : true,
            data      : [
                { y: '2011 Q1', item1: 2666, item2: 2666 },
                { y: '2011 Q2', item1: 2778, item2: 2294 },
                { y: '2011 Q3', item1: 4912, item2: 1969 },
                { y: '2011 Q4', item1: 3767, item2: 3597 },
                { y: '2012 Q1', item1: 6810, item2: 1914 },
                { y: '2012 Q2', item1: 5670, item2: 4293 },
                { y: '2012 Q3', item1: 4820, item2: 3795 },
                { y: '2012 Q4', item1: 15073, item2: 5967 },
                { y: '2013 Q1', item1: 10687, item2: 4460 },
                { y: '2013 Q2', item1: 8432, item2: 5713 }
            ],
            xkey      : 'y',
            ykeys     : ['item1', 'item2'],
            labels    : ['Item 1', 'Item 2'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover : 'auto'
        });
    </script>
@endsection
