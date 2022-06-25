export default {
    isEmpty(data) {
        if(typeof(data) === 'object'){
            if(JSON.stringify(data) === '{}' || JSON.stringify(data) === '[]'){
                return true;
            }else if(!data){
                return true;
            }
            return false;
        }else if(typeof(data) === 'string'){
            if(!data.trim()){
                return true;
            }
            return false;
        }else if(typeof(data) === 'undefined'){
            return true;
        }else{
            return false;
        }
    },
    isEmptyObject(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }

        return true;
    }
}
