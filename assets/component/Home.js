import React, {useState} from 'react';
import * as PropTypes from "prop-types";


function Login() {
    return null;
}

Login.propTypes = {setToken: PropTypes.func};

/**
 * returns the view of the home page used for user login
 * @returns {JSX.Element}
 * @constructor
 */
export const Home = function () {
    const [token, setToken] = useState();

    /*if(!token) {
        return <Login setToken={setToken} />
    }*/

    return (
        <div class='home'>
            <h1>Connection</h1>
            <form>
                <div className="boxlabel">
                    <label>Nom:</label>
                    <label>Prenom:</label>
                    <label>Password:</label>
                </div>
                <div className="boxinput">
                    <input type="text" name="name" id="name"/>
                    <input type="text" name="lastname" id="lastname"/>
                    <input type="password" name="password" id="password"/>
                </div>
            </form>
            <div className="button">
                <button type="submit">Envoyer</button>
            </div>
        </div>
    );
}
