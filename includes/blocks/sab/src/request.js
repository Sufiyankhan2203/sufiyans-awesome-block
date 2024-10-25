import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const useFetchData = (url) => {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await apiFetch({ path: url });
                if (response && response.data) {
                    setData(response);
                } else {
                    throw new Error('No data found');
                }
            } catch (err) {
                setError(err);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [url]);

    return [data, loading, error];
};

export default useFetchData;
