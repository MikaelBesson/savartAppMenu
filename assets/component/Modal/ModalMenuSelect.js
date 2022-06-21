import 'antd/dist/antd.css';
import {useState, useEffect} from "react";
import {Select} from "antd";


export const ShowModalMenu = function() {
    const [recipe, setRecipe] = useState([]);
    useEffect(() => {
            async function getRecipe() {
                const data = await fetch(`/api/recipe`);
                setRecipe(await data.json());
            }
            /**
             *  getRecipe()
             *  .catch(() => alert('Erreur pendant la recuperation des données'));
             */
        },
        []);

    return  (
        <>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez une entrée"}
            >
            </Select>
            <br/>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez un plat"}
            >
            </Select>
            <br/>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez un accompagnement"}
            >
            </Select>
            <br/>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez un fromage"}
            >
            </Select>
            <br/>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez un dessert"}
            >
            </Select>
            <br/>
            <Select
                className="ant-select-selection-overflow"
                placeholder={"Choisisez un fruit"}
            >
            </Select>
            <br/>
            <div className={"modalFooter"}>
                <a href="">Enregistrer</a>
                <a href={"/appmenu"}>Retour au Menu</a>
            </div>
        </>
    );
}














