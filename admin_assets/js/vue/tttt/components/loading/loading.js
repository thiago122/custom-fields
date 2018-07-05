

/* COMPONENT */
// var loadingTpl = ''
// loadingTpl +='        <span v-if=" counter > 0 ">';
// loadingTpl +='            <div class="loading-container">';
// loadingTpl +='                <div class="loading-inner">';
// loadingTpl +='                  {{text_loading}}';
// loadingTpl +='                    <div class="progress progress-sm active" style="margin:0">';
// loadingTpl +='                        <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;">';
// loadingTpl +='                            <span class="sr-only"></span>';
// loadingTpl +='                        </div>';
// loadingTpl +='                    </div>';
// loadingTpl +='                </div>';
// loadingTpl +='            </div>';
// loadingTpl +='        </span>';

var vLoading = Vue.extend({
    ///template: loadingTpl,
    template: "\n<span v-if=\" counter > 0 \">\n    <div class=\"loading-container\">\n        <div class=\"loading-inner\">\n          {{text_loading}}\n            <div class=\"progress progress-sm active\" style=\"margin:0\">\n                <div class=\"progress-bar progress-bar-success progress-bar-striped\" style=\"width: 100%;\">\n                    <span class=\"sr-only\"></span>\n                </div>\n            </div>\n        </div>\n    </div>\n</span>\n",
    data: function () {
        return {
            counter: 0,
            text_loading: 'Loading...'
        }
    },

    mounted: function() {
        bus.$on('loadAdd', this.add );
        bus.$on('loadRemove', this.remove );
    },

    methods: {

        add: function(){

            this.counter++ ;
        },

        remove: function(){
            this.counter-- ;
        },
    }

});

Vue.component('loading', vLoading);
