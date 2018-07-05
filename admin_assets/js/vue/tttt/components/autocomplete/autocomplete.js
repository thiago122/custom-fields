var Autocomplete = Vue.extend({
    template: "    <div class=\"ts-autocomplete-wrapper\">\r\n        <div class=\"ts-autocomplete\">\r\n<!--             <input class=\"form-control\" type=\"text\" v-model=\"query\" :placeholder=\"placeholder\"\r\n\r\n            @input=\"find($event.target.value)\"\r\n            @blur=\"blur()\"\r\n            @keydown.down=\"down()\"\r\n            @keydown.up=\"up()\"\r\n            @keydown.esc=\"esc()\"\r\n            @keydown.enter=\"select()\"\r\n            /> -->\r\n\r\n            <div class=\"has-feedback\">\r\n                <input class=\"form-control\" type=\"text\" v-model=\"query\" :placeholder=\"placeholder\"\r\n                    @input=\"find($event.target.value)\"\r\n                    @blur=\"blur()\"\r\n                    @keydown.down=\"down()\"\r\n                    @keydown.up=\"up()\"\r\n                    @keydown.esc=\"esc()\"\r\n                    @keydown.enter=\"select()\"\r\n\r\n                >\r\n                <i class=\"glyphicon glyphicon-search form-control-feedback\"></i>\r\n            </div>  \r\n\r\n\r\n            <div class=\"options-container\" v-if=\"showOptions\">\r\n                <ul>\r\n                    <li v-for=\"(listItens, index) in itens\" @click=\"selectClick(index)\"  v-bind:class=\"{ \'bg-primary\': index === selected }\">\r\n                        {{ listItens.value }} \r\n                    </li>\r\n                    <li v-if=\"notFound\">\r\n                        {{notFoundMessage}}\r\n                    </li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </div>",
    data: function () {
        return { 
            query: '',
            itens: '',
            ajaxItens: '',
            selected: -1,
            notFound: false,
        }
    },
    props: {
        q: {
            type: String,
            default: 'sdfsdfsdf'
        },

        eventName: {
            type: String,
            default: 'autocomplete'
        },

        keyObject: {
            type: String,
            default: 'id'
        },

        valObject: {
            type: String,
            default: 'name'
        },

        source: {
            type: String,
            default: 'name'
        },

        notFoundMessage: {
            type: String,
            default: 'Não encontrado'
        },

        placeholder: {
            type: String,
            default: ''
        },

        segment: {
            type: String,
            default: ''
        },
        resetOnSelect: {
            type: Boolean,
            default: true
        },
    },

    watch: {
        q: function(){
            this.query = this.q
        }
    },

    computed: {
        showOptions: function(){
            return this.itens.length > 0 || this.notFound
        },

    },

    methods: {
        
        isActive: function(index) {
            return index === this.current;
        },

        enter() {
            this.selection = this.matches[this.current];
            this.open = false;
        },

        up: function() {
            if(this.selected > 0){
                this.selected--;
            }
        },

        down: function() {
            if(this.selected < this.itens.length - 1){ 
                this.selected++; 
            }
        },

        esc: function(){
            this.reset();
        },
        blur: function(){
            var self = this;
            setTimeout(function(){
                self.clearOptions();
            }, 300)
            
        },
        reset: function(){
            this.query = '';
            this.clearOptions();
            this.$emit('input', '');
        },

        clearOptions: function(){
            this.itens ='';
            this.ajaxItens = '';
            this.selected = -1;
            this.notFound = false;
        },

        selectClick(index) {
            this.selected = index;
            this.select();
        },

        select: function(){

            itemAjax = this.ajaxItens[this.selected] ;
            
            // this.$dispatch(this.eventName, itemAjax);
            //bus.$emit(this.eventName, itemAjax); 

            this.$emit('input', itemAjax[this.valObject]);

            this.$emit('id', itemAjax[this.keyObject]);
            this.$emit('value', itemAjax[this.valObject]);
            this.$emit('object', itemAjax);

            this.query = itemAjax[this.valObject];

            if( this.resetOnSelect === true ){
                this.reset();
            }else{
                this.clearOptions();
            }
        },

        find: function(value){

            this.$emit('input', value)
            this.$emit('value', value)
            this.$emit('id', '')
          
            var self    = this;
            var url     = self.source+'/'+self.segment ;
            var compiledItens = [];

            self.notFound = false;

            $.getJSON( url, { q: this.query } )
            .done(function( data ) {
                
                self.ajaxItens = data;
                data.forEach(function(current){
                    compiledItens.push({
                        key:current[self.keyObject],
                        value:current[self.valObject]
                    });

                });

                self.itens = compiledItens;
                if( compiledItens.length < 1 ){
                    if(self.query.length > 0){
                        self.notFound = true;
                    }
                }
            })
            .fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Failed: " + err );
            });

        }
    }

});

Vue.component('autocomplete', Autocomplete);