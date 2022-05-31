import React from 'react';
import { BrowserRouter, Route, Routes } from "react-router-dom";
import '../scss/app.scss';
import Home from '../component/Home';
import Header from "../component/Header";
import {RouteNotFound} from "../component/RouteNotFound";
import {UserRegister} from "../component/UserRegister";
import * as ReactDOM from "react-dom";

ReactDOM.render(

    <BrowserRouter>
        <img src="../images/fondecran2.jpg" alt="/" id="fondecran"/>
        <Header />
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="UserRegister" element={<UserRegister />} />
            <Route path="*" element={<RouteNotFound />} />
        </Routes>
    </BrowserRouter>,

document.getElementById('root'));
