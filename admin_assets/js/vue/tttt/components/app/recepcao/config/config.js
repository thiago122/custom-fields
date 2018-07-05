
//  bus.$emit('alert', msg, 'danger');


// var alertTpl = '';
// alertTpl +='    <div class="container-alerts">';
// alertTpl +='        <template v-for="(alert, index) in alerts">';
// alertTpl +='            <div :class="alert.type" role="alert">{{alert.msg}}</div>';
// alertTpl +='        </template>        ';
// alertTpl +='    </div>';

var Alert = Vue.extend({
    // template: alertTpl,
    template: "<div class=\"container-alerts\">\n    <template v-for=\"(alert, index) in alerts\">\n        <div :class=\"alert.type\" role=\"alert\">{{alert.msg}}</div>\n    </template>\n</div>\n",
    data: function () {
        return {
            alerts:[]
        }
    },


    mounted : function() {
        bus.$on('alert', this.mid )
        bus.$on('alert_mult', this.mid )
    },

    props: {
    },

    computed: {
    },

    methods: {

        mid: function(msg, type){
            if( msg.constructor === Array ){
                this.mult_add(msg, type)
            }else{
                this.add(msg, type)
            }
        },

        mult_add: function(msgs, type){
            for (var i = 0; i < msgs.length; i++) {
                this.add(msgs[i], 'alert alert-'+type);
            }
        },

        add: function(msg, type){

            var self = this;
            var uniqId = this.guid()

            var confAlert = {msg: msg, type: 'alert alert-'+type, id: uniqId};

            this.alerts.push(confAlert);

            setTimeout(function(){
                self.remove(uniqId)
            }, 5000);
        },

        remove: function(id){
            for (var i = this.alerts.length - 1; i >= 0; i--) {
                if(this.alerts[i].id == id){
                    this.alerts.splice(i, 1);
                }
            }
        },

        guid: function() {
          function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
              .toString(16)
              .substring(1);
          }
          return s4() + s4() + '-' + s4() + '-' + s4() + '-' +  s4() + '-' + s4() + s4() + s4();
        }
    }

});

Vue.component('alert', Alert);
