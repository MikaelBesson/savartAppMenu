import {ShowModalMenu} from "../Modal/ModalMenuSelect";
import {BrowserRouter} from "react-router-dom";
import * as ReactDOM from "react-dom";
import {useState} from "react";

export const DayElement = function({ dayName, type }) {
    const [category, setCategory] = useState('');

    /**
     * Handle selection button click to select menu.
     */
    function selectionButtonClicked() {
        return ReactDOM.render(
            <BrowserRouter>
                <div className={"modalMenu"}>
                    <p>Menu pour le {dayName} {type}</p>
                    <ShowModalMenu />
                </div>
            </BrowserRouter>,

            document.getElementById('root')
        );
        /**
         * console.log("Jour: ", dayName);
         * console.log("Type: ", type );
         */
    }

    return (
       <td className={"box-select"}>
           <button onClick={() => selectionButtonClicked()} className="select">Selection</button>
       </td>
    );
}