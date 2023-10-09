import axios from "axios";

export const getMovieList = async () => {
    const movie = await axios.get(`${process.env.REACT_APP_BASEURL}/movie/popular?api_key=${process.env.REACT_APP_KEY}`);
    // console.log({ movielist: movie });
    return movie.data.results;
};

export const topMovieList = async () => {
    const movie = await axios.get(`${process.env.REACT_APP_BASEURL}/movie/top_rated?api_key=${process.env.REACT_APP_KEY}`);
    // console.log({ toplist: movie });
    return movie.data.results;
};

export const searchMovie = async (q) => {
    const search = await axios.get(`${process.env.REACT_APP_BASEURL}/search/movie?query=${q}&api_key=${process.env.REACT_APP_KEY}`);
    return search.data.results;
};
