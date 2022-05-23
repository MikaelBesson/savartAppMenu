import React from 'react';

export const ConnectUser = function () {
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