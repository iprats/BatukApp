const express = require('express');
const router = express();
const Band = require('../classes/Band');
const User = require('../classes/User');
const Instrument = require('../classes/Instrument');

const genericUserBody = {
    include: [
        {
            model: Band,
            through: {
                attributes: []
            },
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        },
        {
            model: Instrument,
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        }
    ],
    attributes: {
        exclude: ["createdAt", "updatedAt"]
    }
}

/** GET ALL USERS **/
/**
 * @swagger
 * /users/band/:band_idband:
 *      get:
 *          summary: Get a list of all the users that belong to a band
 *          description: Sames as summary
 *          parameters:
 *              - in: path
 *                name: band_idband
 *                required: true
 *                type: integer
 *                description: The ID from the band which you want to retrive the users from
 *          produces:
 *              - application/json
 *          responses:
 *              200:
 *                  description: OK
 *                  schema:
 *                      type: array
 *                      items: 
 *                          $ref: '#/components/schemas/User'
 */
router.get('/band/:band_idband', (req, res) => {
    User.findAll({
        include: [
            {
                model: Band,
                where: {
                    idband: req.params.band_idband
                },
                through: {
                    attributes: []
                },
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            },
            {
                model: Instrument,
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            }
        ]
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET ALL USERS **/
router.get('/email/:email', (req, res) => {
    User.findAll({
        ...genericUserBody,
        where: {
            email: req.params.email
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;