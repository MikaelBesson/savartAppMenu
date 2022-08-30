import React, { useState } from "react";

/**
 * returns the view of the home page used for user login
 * @returns {JSX.Element}
 * @constructor
 */
export const Home = function () {
  const [token, setToken] = useState();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  // On envoie vers le serveur !!
  const request = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      username: email,
      password,
    }),
  };
  fetch("/api/login", request).then((r) => console.log(r));
};
