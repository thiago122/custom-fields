
// var tsCalendarTpl = '<div id="ts-calendar" class="ts-calendar">';

//     tsCalendarTpl += '<div class="calendar-header">';
//     tsCalendarTpl +=     '<div class="calendar-directions" id="calendar-prev" @click="goToPrevMonth()">&nbsp; << </div>';
//     tsCalendarTpl +=     '<div class="calendar-directions" id="calendar-next" @click="goToNextMonth()">&nbsp; >> </div>';
//     tsCalendarTpl +=     '<div class="calendar-title">{{currentMonthName}} {{year}}</div>' ;
//     tsCalendarTpl += '</div>';

//     tsCalendarTpl +='<div class="calendar-week">';
//     tsCalendarTpl +='    <div class="calendar-week-day">Dom</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Seg</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Ter</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Qua</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Qui</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Sex</div>';
//     tsCalendarTpl +='    <div class="calendar-week-day">Sab</div>';
//     tsCalendarTpl +='</div>';

//     tsCalendarTpl +='<template v-for="day in currentMonthDays">';
//     tsCalendarTpl +='<div class="calendar-week-day day-now " :class="{hasEvent: day.hasEvent}" v-if="day.isToday" @click="selectedDay(day)" v-html="day.number"> </div>';
//     tsCalendarTpl +='<div class="calendar-week-day"  :class="{hasEvent: day.hasEvent}" v-else @click="selectedDay(day)" v-html="day.number"> </div>';

//     tsCalendarTpl +='</template>';

//     tsCalendarTpl +='</div>';

var tsCalendar = Vue.extend({

    template: "\n<div id=\"ts-calendar\" class=\"ts-calendar\">\n\n    <div class=\"calendar-header\">\n        <div class=\"calendar-directions\" id=\"calendar-prev\" @click=\"goToPrevMonth()\">&nbsp; << </div>\n        <div class=\"calendar-directions\" id=\"calendar-next\" @click=\"goToNextMonth()\">&nbsp; >> </div>\n        <div class=\"calendar-title\">{{currentMonthName}} {{year}}</div>\n    </div>\n\n    <div class=\"calendar-week\">\n        <div class=\"calendar-week-day\">Dom</div>\n        <div class=\"calendar-week-day\">Seg</div>\n        <div class=\"calendar-week-day\">Ter</div>\n        <div class=\"calendar-week-day\">Qua</div>\n        <div class=\"calendar-week-day\">Qui</div>\n        <div class=\"calendar-week-day\">Sex</div>\n        <div class=\"calendar-week-day\">Sab</div>\n    </div>\n\n    <template v-for=\"day in currentMonthDays\">\n    <div class=\"calendar-week-day day-now \" :class=\"{hasEvent: day.hasEvent}\" v-if=\"day.isToday\" @click=\"selectedDay(day)\" v-html=\"day.number\"> </div>\n    <div class=\"calendar-week-day\"  :class=\"{hasEvent: day.hasEvent}\" v-else @click=\"selectedDay(day)\" v-html=\"day.number\"> </div>\n    </template>\n\n</div>\n",

    data: function () {
        return {
            initialDate  :'yyyy-mm-dd',
            dateNow      : null, // dateObj
            year         : null,
            month        : null,
            day          : null,
            monthDays    : null,
            WeekDayOfTheFistDayOfMonth  : null,
            monthNames   : ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro", "Dezembro"],
            dayNames     : ["Domingo","Segunda","Terça","Quarta","Quinta","Sexta", "Sábado"],
        }
    },

    props: ['diasMes'],

    mounted: function() {
        this.dateNow = this.getDateNow();
        this.init()
        this.setInitialDate();
    },

    computed: {

        currentMonthName: function(){
            return this.monthNames[this.month];
        },

        currentMonthDays: function(){

            var monthDays = [];
            var WeekDayOfTheFistDayOfMonth = JSON.parse(JSON.stringify(this.WeekDayOfTheFistDayOfMonth))

            while (WeekDayOfTheFistDayOfMonth > 0){

                monthDays.push({
                        number: ' &nbsp; ',
                        isToday: false
                });

                // used in next loop.
                WeekDayOfTheFistDayOfMonth--;
            }

            for (var i = 1; i <= this.monthDays; i++) {

                var day = this.zeroFill(2, i);
                var month = this.monthPlusOne();
                var date = this.year + '-' + month  + '-' + day

                var currDay = {
                    number: i,
                    date: date,
                    hasEvent: this.findDayOfMonth(date) ,
                }

                if (this.isInitialDate(i)){
                    currDay.isToday = true
                }else{
                    currDay.isToday = false
                }

                monthDays.push( currDay );
            }

            return monthDays;
        },

    },

    methods: {

        monthPlusOne: function(){
            var month = parseInt(this.month) + 1;
            return this.zeroFill(2, month)
        },

        findDayOfMonth: function(day){

            var found = false;

            this.diasMes.forEach(function(currDay, index){
                if(currDay.data == day){
                    found = true;
                }
            });

            return found;
        },

        init: function(){
            this.year         = this.getYear();
            this.month        = this.getMonth();
            this.day          = this.getDay();
            this.monthDays    = this.daysInMonth();
            this.WeekDayOfTheFistDayOfMonth  = this.getWeekDayOfTheFistDayOfMonth();
        },

        setInitialDate: function(){
            this.initialDate = this.year + '-' + this.month + '-' + this.day;
        },

        isInitialDate: function(currentDay){
            if( this.initialDate == (this.year + '-' + this.month + '-' + currentDay)){
                return true;
            }
            return false;
        },

        //Determing if February (28,or 29)
        febNumberOfDays: function(){
            if ( (this.year%100!=0) && (this.year%4==0) || (this.year%400==0)){
                return 29;
            }
            return 28;
        },

        // quantidade de dias do mês
        daysInMonth: function() {
            return new Date(this.year, (this.month +1) , 0).getDate();
        },

        // determina qual é o dia da semana do primeiro dia do mês
        getWeekDayOfTheFistDayOfMonth: function(){
            var firstDayOfTheMonth = new Date(this.year, this.month, 1);
            return firstDayOfTheMonth.getDay();
        },

        getDay: function(){
            if(typeof _day == 'undefined'){
                return this.dateNow.getDate();
            }
            return _day;
        },

        getMonth: function(){
            if(typeof _month == 'undefined'){
                return this.dateNow.getMonth();
            }else{
                return _month - 1;
            }
        },

        getYear: function(){
            if(typeof _year == 'undefined'){
                return this.dateNow.getFullYear();
            }
            return _year;
        },

        getDateNow: function(){
            return new Date();
        },

//----------------------------------------------------------------

        getNextYear: function(){
            return new Date(this.year, (this.month +1) ).getFullYear();
        },

        getPrevYear: function(){
            return new Date(this.year, (this.month - 1) ).getFullYear();
        },

        getNextMonth: function(){
            return new Date(this.year, (this.month +1) ).getMonth();
        },

        getPrevMonth: function(){
            console.log( new Date(this.year, (this.month - 1) ).getMonth() )
            return new Date(this.year, (this.month - 1) ).getMonth();
        },

// ----------------------------------------------------------------

        nextMonth: function(){

            var newDate = new Date(this.year, this.month);
            var newDate = new Date(new Date(newDate).setMonth(newDate.getMonth()+1));

            var data = {
                year: newDate.getFullYear(),
                month: newDate.getMonth()+1,
                date: newDate
            }

            this.$emit('nextMonth', data),
            this.$emit('month', data),

            this.dateNow = newDate;
        },

        prevMonth: function(){

            var newDate = new Date(this.year, this.month);
            var newDate = new Date(new Date(newDate).setMonth(newDate.getMonth()-1));

            var data = {
                year: newDate.getFullYear(),
                month: newDate.getMonth()+1,
                date: newDate
            }

            this.$emit('prevMonth', data),
            this.$emit('month', data),

            this.dateNow = newDate;
        },

        selectedDay: function( day ){
            this.$emit('day', day);
        },

// ----------------------------------------------------------------

        goToNextMonth: function(){
            this.nextMonth();
            this.init();
        },

        goToPrevMonth: function(){
            this.prevMonth();
            this.init();
        },

        // https://github.com/feross/zero-fill
        zeroFill: function (width, number, pad) {
          if (number === undefined) {
            return function (number, pad) {
              return zeroFill(width, number, pad)
            }
          }
          if (pad === undefined) pad = '0'
          width -= number.toString().length
          if (width > 0) return new Array(width + (/\./.test(number) ? 2 : 1)).join(pad) + number
          return number + ''
        }


    }

});

Vue.component('tsCalendar', tsCalendar);
