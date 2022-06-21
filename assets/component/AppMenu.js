import React from 'react';
import {DayElement} from "./MenuTable/DayElement";
import {DayElementHeader} from "./MenuTable/DayElementHeader";

/**
 * returns the menu application view
 * @returns {JSX.Element}
 * @constructor
 */
export const AppMenu = function () {
    const days = [1, 2, 3, 4, 5, 6, 7];
    const daysNames = [ 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

    return (
        <div className="appMenu">
            <h1>Menu de la semaine</h1>
            <table>
                <thead>
                    <tr>
                        <td>jours/Repas</td>
                        { daysNames.map( dayName =>
                            <DayElementHeader key={dayName} text={dayName} />
                        ) }
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th className={"box-title"}>Repas midi</th>
                        { days.map( day =>
                            <DayElement key={1 + day} dayName={daysNames[day - 1]} type={'midi'} />
                        ) }
                    </tr>
                    <tr>
                        <th className={"box-title"}>Repas soir</th>
                        { days.map( day =>
                            <DayElement key={2 + day}  dayName={daysNames[day - 1]} type={'soir'} />
                        ) }
                    </tr>
                </tbody>
            </table>
            <div className='table-footer'>
                <a href="">Voir la liste des courses</a>
            </div>
        </div>
    );
}
