import 'antd/dist/antd.css';
import {useEffect, useState} from "react";

export const ShowModalMenu = function() {
    const [category, setCategory] = useState([]);

    useEffect(() => {
       fetch('/api/category/all')
           .then(categories => categories.json())
           .then(categories => setCategory(categories))
           .catch(error => console.error("error de récupération"))
    }, []);

    console.log(category);

    return  (
        <div className={"modal-menu-selection"}>
            <select>
            {category.map(item =>(
                <option key = {item.id}>
                   {item.name}
                </option>
            ))}
            </select>
           {/* <a href="">Enregistrer</a>
            <a href={"/appmenu"}>Retour au Menu</a>*/}
        </div>

    );
}














