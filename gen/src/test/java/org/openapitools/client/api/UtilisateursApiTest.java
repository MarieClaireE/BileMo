/*
 * Bilemo API
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 0.1.9
 * 
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


package org.openapitools.client.api;

import org.openapitools.client.ApiException;
import org.openapitools.client.model.InlineObject;
import org.openapitools.client.model.InlineObject1;
import org.openapitools.client.model.Utilisateurs;
import org.junit.Test;
import org.junit.Ignore;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * API tests for UtilisateursApi
 */
@Ignore
public class UtilisateursApiTest {

    private final UtilisateursApi api = new UtilisateursApi();

    
    /**
     * Retourne un tableau d&#39;utilisateurs
     *
     * 
     *
     * @throws ApiException
     *          if the Api call fails
     */
    @Test
    public void utilisateursGetTest() throws ApiException {
        List<Utilisateurs> response = api.utilisateursGet();

        // TODO: test validations
    }
    
    /**
     * Créer un utilisateur
     *
     * 
     *
     * @throws ApiException
     *          if the Api call fails
     */
    @Test
    public void utilisateursPostTest() throws ApiException {
        InlineObject inlineObject = null;
        api.utilisateursPost(inlineObject);

        // TODO: test validations
    }
    
    /**
     * Supprimer un utilisateur
     *
     * 
     *
     * @throws ApiException
     *          if the Api call fails
     */
    @Test
    public void utilisateursUserIdDeleteTest() throws ApiException {
        Long userId = null;
        api.utilisateursUserIdDelete(userId);

        // TODO: test validations
    }
    
    /**
     * Retourne les détails d&#39;un utilisateur
     *
     * 
     *
     * @throws ApiException
     *          if the Api call fails
     */
    @Test
    public void utilisateursUserIdGetTest() throws ApiException {
        Long userId = null;
        Utilisateurs response = api.utilisateursUserIdGet(userId);

        // TODO: test validations
    }
    
    /**
     * Modifier un utilisateur
     *
     * 
     *
     * @throws ApiException
     *          if the Api call fails
     */
    @Test
    public void utilisateursUserIdPutTest() throws ApiException {
        Long userId = null;
        InlineObject1 inlineObject1 = null;
        api.utilisateursUserIdPut(userId, inlineObject1);

        // TODO: test validations
    }
    
}
