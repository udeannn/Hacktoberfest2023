import "./App.css";
import { getMovieList, searchMovie, topMovieList } from "./api";
import { useEffect, useState } from "react";

export default function App() {
    const [popularMovie, setPopularMovie] = useState([]);
    const [topMovie, setTopMovie] = useState([]);
    useEffect(() => {
        getMovieList().then((result) => {
            setPopularMovie(result);
        });
    }, []);
    // useEffect(() => {
    //     setTopMovie(topMovieList());
    // }, []);
    const search = async (q) => {
        if (q.length > 3) {
            const query = await searchMovie(q);
            setPopularMovie(query);
        }
    };
    const PopularMovieList = () => {
        return popularMovie.map((movie, i) => {
            return (
                <div className="app-wrapper" key={i}>
                    <div className="movie-title">{movie.title}</div>
                    <img className="movie-image" src={`${process.env.REACT_APP_BASEIMGURL}/${movie.poster_path}`}></img>
                    <div className="movie-date">{movie.release_date}</div>
                    <div className="movie-rate">{movie.vote_average}</div>
                </div>
            );
        });
    };
    return (
        <div className="App">
            <header className="App-header">
                <h1>RYAN MOVIE MANIA</h1>
                <input className="movie-search" placeholder="Cari film disini.." onChange={({ target }) => search(target.value)}></input>
                <div className="app-container">
                    <PopularMovieList />
                </div>
            </header>
        </div>
    );
}
