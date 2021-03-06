'use strict';
angular.module('showcase.withScroller', ['datatables', 'datatables.scroller'])
.controller('WithScrollerCtrl', WithScrollerCtrl);

function WithScrollerCtrl(DTOptionsBuilder, DTColumnBuilder) {
    var vm = this;
    vm.dtOptions = DTOptionsBuilder.fromSource('data.json')
        .withDOM('lfrti')
        .withScroller()
        .withOption('deferRender', true)
        // Do not forget to add the scorllY option!!!
        .withOption('scrollY', 200);
    vm.dtColumns = [
        DTColumnBuilder.newColumn('id').withTitle('ID'),
        DTColumnBuilder.newColumn('firstName').withTitle('First name'),
        DTColumnBuilder.newColumn('lastName').withTitle('Last name')
    ];
}
