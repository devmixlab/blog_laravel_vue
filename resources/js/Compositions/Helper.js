// import {ref} from 'vue'
import moment from "moment";

export default function Helper(){

    function formatDate(date, format = 'MMMM D, YYYY') {
        return moment(date).format(format);
    }

    function firstLetterToUppercase(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function cutText(str, length) {
        if(str.length <= length)
            return str;

        return str.slice(0, length) + '...';
    }

    function getUrlQueryParamsAsObj(except = [], only = false) {
        var search = location.search.substring(1);
        if(!search)
            return {};
        // console.log(search)
        const obj = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
        if(!Array.isArray(except) || except.length == 0)
            return obj;

        if(only){
            const out = {}
            for(let key of except){
                if(typeof obj[key] !== 'undefined')
                    out[key] = obj[key];
            }
            return out;
        }

        for(let key of except){
            delete obj[key];
        }

        return obj;
    }

    function debounce(fn, wait){
        let timer;
        return function(...args){
            if(timer) {
                clearTimeout(timer); // clear any pre-existing timer
            }
            const context = this; // get the current context
            timer = setTimeout(()=>{
                fn.apply(context, args); // call the function if time expires
            }, wait);
        }
    }

    // function debounce(func, wait, immediate) {
    //     // console.log(arguments)
    //     // return function () {
    //     //     console.log(arguments)
    //     //     // func();
    //     // }
    //     // console.log(func)
    //     // func();
    //     var timeout;
    //     return function() {
    //         var context = this, args = arguments;
    //         // console.log(11)
    //         // func.apply(context, args);
    //         var later = function() {
    //             timeout = null;
    //             if (!immediate) func.apply(context, args);
    //             func.apply(context, args);
    //         };
    //         var callNow = immediate && !timeout;
    //         clearTimeout(timeout);
    //         timeout = setTimeout(later, wait);
    //         if (callNow) func.apply(context, args);
    //     };
    // }

    // const reuseData = ref ("Reusable data")
    // function reuseMethod() {
    //     console.log(reuseData.value);
    //     console.log('Hello from Reusable method!')
    // }
    return {
        formatDate,
        firstLetterToUppercase,
        cutText,
        getUrlQueryParamsAsObj,
        debounce,
    }
}
