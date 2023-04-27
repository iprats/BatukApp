const express = require('express');
const router = express();
const Event = require('../classes/Event');
const Band = require('../classes/Band');
const Assistance = require('../classes/Assistance');
const moment = require('moment')
const { Op } = require('sequelize')

const genericEventBody = {
    include: [
        {
            model: Band,
            attributes: {
                exclude: ["updatedAt", "createdAt"]
            }
        },
        // {
        //     model: Assistance,
        //     attributes: {
        //         exclude: ["updatedAt", "createdAt"]
        //     }
        // }
    ],
    attributes: {
        exclude: ["createAt", "updatedAt"]
    }
}

/**
 * GET AN EVENT BY BAND ID FROM A CERTAIN MONTH
 * 
 * @swagger
 * /events/:idband/date/:month:
 *      get:
 *          summary: Get a list of all the events that belong to a band in a certain month (with a week margin before and after)
 *          parameters:
 *              - in: path
 *                name: idband
 *                required: true
 *                type: integer
 *                description: The ID from the band which you want to retrive the events from
 *              - in: path
 *                name: month
 *                required: true
 *                type: integer
 *                description: The month from the events you want to search
 *          produces:
 *              - application/json
 */
router.get('/:idband/date/:month', (req, res) => {
    Event.findAll({
        // where: {
        //     band_idband: req.params.idband
        // }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/**
 * PUT AN EVENT INFO
 * 
 * @swagger
 * /events/:idevent:
 *      put:
 *          summary: Put the info about an existing event
 *          parameters:
 *              - in: path
 *                name: idevent
 *                required: true
 *                type: integer
 *          requestBody:
 *              required: true
 *              content:
 *                  application/json:
 *                      schema:
 *                          type: object
 *                          properties:
 *                              name:
 *                                  type: string
 *                                  example: Aniversari de la banda
 *                              description:
 *                                  type: string
 *                                  example: Festa per l'aniversari de la creació de la banda amb actuació en viu i molta cervesa
 *                              location:
 *                                  type: string
 *                                  example: C. de Sta. Eugènia, 146, 17006 Girona
 *                              datetime:
 *                                  type: datetime
 *                                  example: 27/08/2023 18:00:00
 *                              idband:
 *                                  type: integer
 *                                  example: 1
 */
router.put('/:idevent', (req, res) => {
    Event.update({
        name: req.body.name,
        description: req.body.description,
        location: req.body.location,
        datetime: req.body.datetime,
        band_idband: req.body.idband

    }, {
        where: {
            idevent: req.params.idevent
        }
    })
    .then(result => res.json(result).status(200))
    .catch(error => res.error(error))
})

/**
 * POST AN EVENT
 * 
 * @swagger
 * /events/:
 *      post:
 *          summary: Create a new event
 *          requestBody:
 *              required: true
 *              content:
 *                  application/json:
 *                      schema:
 *                          type: object
 *                          properties:
 *                              name:
 *                                  type: string
 *                                  example: Aniversari de la banda
 *                              description:
 *                                  type: string
 *                                  example: Festa per l'aniversari de la creació de la banda amb actuació en viu i molta cervesa
 *                              location:
 *                                  type: string
 *                                  example: C. de Sta. Eugènia, 146, 17006 Girona
 *                              datetime:
 *                                  type: datetime
 *                                  example: 27/08/2023 18:00:00
 *                              idband:
 *                                  type: integer
 *                                  example: 1
 */
router.post('/', (req, res) => {
    Event.create({
        name: req.body.name,
        description: req.body.description,
        location: req.body.location,
        datetime: req.body.datetime,
        band_idband: req.body.idband
    })
    .then(result => res.json(result).status(200))
    .catch(error => res.error(error))
})


module.exports = router