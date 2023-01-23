import { useEffect, useState } from 'react';
import axios from 'axios';

function Roledata() {

    const [data, setData] = useState('');

    useEffect(() => {
    
        axios.get('/api/all-role')
        .then(function (response) {
            const data = response.data.data;
            setData(data);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });

    }, []);

    return data
        
}

export default Roledata;