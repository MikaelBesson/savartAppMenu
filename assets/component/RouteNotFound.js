import React from 'react';
import {useParams} from "react-router-dom";
import Swal from "sweetalert2";

/**
 * returns the view of an error message if the page does not exist
 * @returns {JSX.Element}
 * @constructor
 * @see https://github.com/sweetalert2/sweetalert2-react-content
 */
export const RouteNotFound = function () {
    const params = useParams();

    return (
        <div className="RouteNotFound">
            Erreur, la page: <strong> {params["*"]}</strong> n'existe pas !<br/>
            <a href="/">Retour</a>
        </div>
    );
};