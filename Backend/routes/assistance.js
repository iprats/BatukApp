const express = require('express');
const router = express();
const Assistance = require('../classes/Assistance')

// TO GET ANSWER ENUM VALUES USE <Assistance.rawAttributes.answer.values>

/**
 * GET ASSISTANCE FROM A USER IN AN EVENT
 * 
 * @swagger
 * /events/:idband/date/:month:
 *      put:
 *          summary: Modify the assistance and/or the instrument of a user in an event
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
 *              - in: body
 *                name: answer
 *                required: true
 *                type: string
 *                description: The answer about the users assistance to the event
 *              - in: body
 *                name: instrument_idinstrument
 *                required: false
 *                type: integer
 *                description: The id of the instrument the user is playing at the event
 *          produces:
 *              - application/json
 */
router.put('/:event_idevent', (req, res) => {
    Assistance.update({
        answer: req.body.answer, 
        instrument_idinstrument: req.body.instrument_idinstrument
    }, {
        where: {
            user_iduser: req.body.user_iduser,
            event_idevent: req.params.event_idevent
        }
    })
    .then(result => res.json(result).status(200))
    .catch(error => res.error(error))
})

router.get('/responses', (_req, res) => {
    res.json(Assistance.rawAttributes.answer.values)
})

module.exports = router