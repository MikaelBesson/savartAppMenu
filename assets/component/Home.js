import React, {useState} from 'react';
import * as PropTypes from "prop-types";

function Login() {
    return null;
}

Login.propTypes = {setToken: PropTypes.func};
export const ConnectUser = function () {
    const [token, setToken] = useState();

    if(!token) {
        return <Login setToken = {setToken} />
    }
        return (
            <div className='userConnect'>
                <h1>Connection</h1>
                <form>
                        <label>
                            Nom:<br/>
                            <input type="text" name="name" id="name"/><br/>
                        </label><br/>
                        <label>
                            Prenom:<br/>
                            <input type="text" name="lastname" id="lastname"/><br/>
                        </label><br/>
                        <label>
                            password:<br/>
                            <input type="password" name="password" id="password"/><br/>
                        </label><br/>
                    <button type="submit">Envoyer</button> <a href="./UserRegister">Inscription</a>
                </form>
            </div>
        );
    }
export default ConnectUser;