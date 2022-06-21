import React from 'react';
import 'antd/dist/antd.css';
import {Select} from 'antd';
const {Option} = Select;
const children = ["b10", "c15", "j45"];


export const ShowModalMenu = function() {

    const handleChange = ({value}) => {
        console.log(`selected ${value}`);
    };


    return (
        <>
            <Select
                mode="multiple"
                style={{
                    width: '60%',
                }}
                placeholder="choisir entree"
                onChange={handleChange}
            >
                {children}
            </Select>
            <br />
            <br />
            <Select
                mode="multiple"
                style={{
                    width: '60%',
                }}
                placeholder="choisir un plat"
                onChange={handleChange}
            >
                {children}
            </Select>
            <br />
            <br />
            <Select
                mode="multiple"
                style={{
                    width: '60%',
                }}
                placeholder="choisir un accompagnement"
                onChange={handleChange}
            >
                {children}
            </Select>
            <br/>
            <br/>
            <button>enregistrer</button>
        </>
    );
}














