function intervalDisplay(vm, date, interval) {
    interval = parseInt(interval);
    switch (interval) {
        case 1:
            return vm.$trans('Every day');
            break;
        case 2:
            return vm.$trans('Every second day');
            break;
        case 3:
            return vm.$trans('Every third day');
            break;
        case 4:
            return vm.$trans('Every fourth day');
            break;
        case 5:
            return vm.$trans('Every fifth day');
            break;
        case 6:
            return vm.$trans('Every sixth day');
            break;
        case 7:
            return vm.$trans('Every %weekDayName%', {weekDayName: displayDay(vm, moment(date).weekday(), false)});
            break;
        case 14:
            return vm.$trans('Every second %weekDayName%', {weekDayName: displayDay(vm, moment(date).weekday(), false)});
            break;
    }
    return vm.$trans('Every %days% days', {days: interval});
}

function displayMonth(vm, month, abbr){
    month = parseInt(month);
    if(abbr){
        switch (month) {
            case 1:
                return vm.$trans('Jan');
            case 2:
                return vm.$trans('Feb');
            case 3:
                return vm.$trans('Mar');
            case 4:
                return vm.$trans('Apr');
            case 5:
                return vm.$trans('May');
            case 6:
                return vm.$trans('Jun');
            case 7:
                return vm.$trans('Jul');
            case 8:
                return vm.$trans('Aug');
            case 9:
                return vm.$trans('Sep');
            case 10:
                return vm.$trans('Oct');
            case 11:
                return vm.$trans('Nov');
            case 12:
                return vm.$trans('Dec');
        }
    }else{
        switch (month) {
            case 1:
                return vm.$trans('January');
            case 2:
                return vm.$trans('February');
            case 3:
                return vm.$trans('March');
            case 4:
                return vm.$trans('April');
            case 5:
                return vm.$trans('May');
            case 6:
                return vm.$trans('June');
            case 7:
                return vm.$trans('July');
            case 8:
                return vm.$trans('August');
            case 9:
                return vm.$trans('September');
            case 10:
                return vm.$trans('October');
            case 11:
                return vm.$trans('November');
            case 12:
                return vm.$trans('December');
        }
    }
    return '';
}

function displayDay(vm, day, abbr){
    day = parseInt(day);
    if(abbr){
        switch (day) {
            case 0:
                return vm.$trans('Sun');
            case 1:
                return vm.$trans('Mon');
            case 2:
                return vm.$trans('Tue');
            case 3:
                return vm.$trans('Wed');
            case 4:
                return vm.$trans('Thu');
            case 5:
                return vm.$trans('Fri');
            case 6:
                return vm.$trans('Sat');
        }
    }else{
        switch (day) {
            case 0:
                return vm.$trans('Sunday');
            case 1:
                return vm.$trans('Monday');
            case 2:
                return vm.$trans('Tuesday');
            case 3:
                return vm.$trans('Wednesday');
            case 4:
                return vm.$trans('Thursday');
            case 5:
                return vm.$trans('Friday');
            case 6:
                return vm.$trans('Saturday');
        }
    }
    return '';
}