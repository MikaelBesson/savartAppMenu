import React, {useState} from 'react';

export const UserRegister = function () {
    const [name, setName] = useState('');
    const [lastName, setLastName] = useState('');
    const [password, setPassword] = useState('');


    const handleRegister = function () {
        console.log('Registering...');
        const {name,lastName,password} = event.target;
        fetch('/userRegister', {
            method: 'POST',
            body: JSON.stringify({
                name: name.value,
                lastName: lastName.value,
                password: password.value
            }),
            headers: {
                'Content-type': 'application/json'
            }
        }).then(response => {
            if(response.ok) {
                console.log('success');
                alert('Bravo, Vous ete maintenant enregistrer !');
            }
            else {
                console.log('error');
                alert("Erreur lors de l'enregistrement");
            }
        })
    };

    return (
        <div className="userRegister">
            <form method="post" onSubmit={handleRegister}>
                <h1>S'enregistrer</h1>
                    <label>Nom</label><br/>
                    <input type="text" name="name"
                           onChange={(e) => setName(e.target.value)} />
                <br/>
                    <label>Prenom</label><br/>
                    <input type="text" name="lastName"
                           onChange={(e) => setLastName(e.target.value)} />
                <br/>
                    <label>Mot de passe</label><br/>
                    <input type="text" name="password"
                           onChange={(e) => setPassword(e.target.value)} />
                <br/>
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    );
};