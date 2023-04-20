const Sequelize = require('sequelize')
const db = require('../connection')

const Assistance = db.define('assistance', {
    idassistance: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    answer: {
        type: Sequelize.ENUM('Si','Si + Transport','Pendent','No')
    }
}, {tableName: 'user'})

module.exports = Assistance