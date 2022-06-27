import 'antd/dist/antd.css';
import {useState} from "react";

export const ShowModalMenu = function({}) {
    const [category, setCategory] = useState('');

    /**
     *  let categorySelect = [];
     *     let ingredientSelect= [];
     *
     *         let data = new XMLHttpRequest();
     *         data.open('GET', '/api/CategoryController');
     *         data.responseType = 'json';
     *         data.onload = () => data.status === 200 && setCategory(data.response);
     *         data.send();
     *
     *         function renderCategories(category) {
     *             if (categorySelect.length > 0) {
     *                 return categorySelect.map((category, index) => (
     *                     <Category key={index} category={category} />
     *                 ));
     *             }
     *             else return [];
     *         }
     * @type {*[]}
     */


    return  (
        <>
            <div>
                <select name="entry-choice" id="entry-choice" placeholder={"choisir une entree"}>
                    <option value={category}>{category.name}</option>
                </select>
            </div>

            <div className={"modalFooter"}>
                <a href="">Enregistrer</a>
                <a href={"/appmenu"}>Retour au Menu</a>
            </div>
        </>
    );
}














