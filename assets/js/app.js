import React from 'react';
import { BrowserRouter, Route, Routes } from "react-router-dom";
import '../scss/app.scss';
import {Home} from '../component/Home';
import {Header} from "../component/Header";
import {RouteNotFound} from "../component/RouteNotFound";
import * as ReactDOM from "react-dom";
import {Admin2} from "../component/Admin2";

ReactDOM.render(

    <BrowserRouter>
        <img src="../images/fondecran2.jpg" alt="/" id="fondecran"/>
        <Header />
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path={"/admin"} element={<Admin2 />} />
            <Route path="*" element={<RouteNotFound />} />
        </Routes>
    </BrowserRouter>,

document.getElementById('root'));
