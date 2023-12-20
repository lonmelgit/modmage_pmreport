define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ModMage_PmReport/ui/grid/cells/text'
        },
        getStatusColor: function (row) {
            if (row.status == 'Warning') {
                return '#FFA07A';
            }
            return '#90EE90';
        }
    });
});
