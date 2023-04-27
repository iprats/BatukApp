const express = require('express');
const router = express();
const Event = require('../classes/Event');

const genericEventBody = {

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

module.exports = router