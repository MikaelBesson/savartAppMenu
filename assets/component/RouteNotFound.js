import React from 'react';
import {useParams} from "react-router-dom";

export const RouteNotFound = function () {
    const params = useParams();

    return (
        <div className="RouteNotFound">
            Erreur, la page: <strong> {params["*"]}</strong> n'existe pas !<br/>
            <a href="/">Retour</a>
        </div>
    );
};