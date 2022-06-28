import {ShowModalMenu} from "../Modal/ModalMenuSelect";
import {useState} from "react";

export const DayElement = function({ dayName, type }) {

    const [showCategories, setShowCategories] = useState(false);

    return (

       <td onClick={() => setShowCategories(!showCategories)} className={"box-select"}>
           Cliquez
           {showCategories && <ShowModalMenu />}
       </td>
    );
}