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

import org.openapitools.client.ApiCallback;
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.ApiResponse;
import org.openapitools.client.Configuration;
import org.openapitools.client.Pair;
import org.openapitools.client.ProgressRequestBody;
import org.openapitools.client.ProgressResponseBody;

import com.google.gson.reflect.TypeToken;

import java.io.IOException;


import org.openapitools.client.model.InlineObject2;
import org.openapitools.client.model.InlineObject3;
import org.openapitools.client.model.Produit;

import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class ProduitsApi {
    private ApiClient localVarApiClient;

    public ProduitsApi() {
        this(Configuration.getDefaultApiClient());
    }

    public ProduitsApi(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    public ApiClient getApiClient() {
        return localVarApiClient;
    }

    public void setApiClient(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    /**
     * Build call for produitsGet
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Liste des produits </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsGetCall(final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/produits";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            "application/json"
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] { "JWT" };
        return localVarApiClient.buildCall(localVarPath, "GET", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call produitsGetValidateBeforeCall(final ApiCallback _callback) throws ApiException {
        

        okhttp3.Call localVarCall = produitsGetCall(_callback);
        return localVarCall;

    }

    /**
     * Retourne la liste des produits
     * 
     * @return List&lt;Produit&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Liste des produits </td><td>  -  </td></tr>
     </table>
     */
    public List<Produit> produitsGet() throws ApiException {
        ApiResponse<List<Produit>> localVarResp = produitsGetWithHttpInfo();
        return localVarResp.getData();
    }

    /**
     * Retourne la liste des produits
     * 
     * @return ApiResponse&lt;List&lt;Produit&gt;&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Liste des produits </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<List<Produit>> produitsGetWithHttpInfo() throws ApiException {
        okhttp3.Call localVarCall = produitsGetValidateBeforeCall(null);
        Type localVarReturnType = new TypeToken<List<Produit>>(){}.getType();
        return localVarApiClient.execute(localVarCall, localVarReturnType);
    }

    /**
     * Retourne la liste des produits (asynchronously)
     * 
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Liste des produits </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsGetAsync(final ApiCallback<List<Produit>> _callback) throws ApiException {

        okhttp3.Call localVarCall = produitsGetValidateBeforeCall(_callback);
        Type localVarReturnType = new TypeToken<List<Produit>>(){}.getType();
        localVarApiClient.executeAsync(localVarCall, localVarReturnType, _callback);
        return localVarCall;
    }
    /**
     * Build call for produitsPost
     * @param inlineObject2  (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit créé </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsPostCall(InlineObject2 inlineObject2, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = inlineObject2;

        // create path and map variables
        String localVarPath = "/produits";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            "application/json"
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] { "JWT" };
        return localVarApiClient.buildCall(localVarPath, "POST", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call produitsPostValidateBeforeCall(InlineObject2 inlineObject2, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'inlineObject2' is set
        if (inlineObject2 == null) {
            throw new ApiException("Missing the required parameter 'inlineObject2' when calling produitsPost(Async)");
        }
        

        okhttp3.Call localVarCall = produitsPostCall(inlineObject2, _callback);
        return localVarCall;

    }

    /**
     * Création d&#39;un produit
     * 
     * @param inlineObject2  (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit créé </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public void produitsPost(InlineObject2 inlineObject2) throws ApiException {
        produitsPostWithHttpInfo(inlineObject2);
    }

    /**
     * Création d&#39;un produit
     * 
     * @param inlineObject2  (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit créé </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> produitsPostWithHttpInfo(InlineObject2 inlineObject2) throws ApiException {
        okhttp3.Call localVarCall = produitsPostValidateBeforeCall(inlineObject2, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     * Création d&#39;un produit (asynchronously)
     * 
     * @param inlineObject2  (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit créé </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsPostAsync(InlineObject2 inlineObject2, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = produitsPostValidateBeforeCall(inlineObject2, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
    /**
     * Build call for produitsProduitIdDelete
     * @param produitId  (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Produit supprimé. </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Le produit est introuvable. </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdDeleteCall(Long produitId, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/produits/{produitId}"
            .replaceAll("\\{" + "produitId" + "\\}", localVarApiClient.escapeString(produitId.toString()));

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] { "JWT" };
        return localVarApiClient.buildCall(localVarPath, "DELETE", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call produitsProduitIdDeleteValidateBeforeCall(Long produitId, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'produitId' is set
        if (produitId == null) {
            throw new ApiException("Missing the required parameter 'produitId' when calling produitsProduitIdDelete(Async)");
        }
        

        okhttp3.Call localVarCall = produitsProduitIdDeleteCall(produitId, _callback);
        return localVarCall;

    }

    /**
     * Suppression d&#39;un produit
     * 
     * @param produitId  (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Produit supprimé. </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Le produit est introuvable. </td><td>  -  </td></tr>
     </table>
     */
    public void produitsProduitIdDelete(Long produitId) throws ApiException {
        produitsProduitIdDeleteWithHttpInfo(produitId);
    }

    /**
     * Suppression d&#39;un produit
     * 
     * @param produitId  (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Produit supprimé. </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Le produit est introuvable. </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> produitsProduitIdDeleteWithHttpInfo(Long produitId) throws ApiException {
        okhttp3.Call localVarCall = produitsProduitIdDeleteValidateBeforeCall(produitId, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     * Suppression d&#39;un produit (asynchronously)
     * 
     * @param produitId  (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Produit supprimé. </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Le produit est introuvable. </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdDeleteAsync(Long produitId, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = produitsProduitIdDeleteValidateBeforeCall(produitId, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
    /**
     * Build call for produitsProduitIdGet
     * @param produitId  (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> JSON de du produit sélectionné </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdGetCall(Long produitId, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/produits/{produitId}"
            .replaceAll("\\{" + "produitId" + "\\}", localVarApiClient.escapeString(produitId.toString()));

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            "application/json"
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] { "JWT" };
        return localVarApiClient.buildCall(localVarPath, "GET", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call produitsProduitIdGetValidateBeforeCall(Long produitId, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'produitId' is set
        if (produitId == null) {
            throw new ApiException("Missing the required parameter 'produitId' when calling produitsProduitIdGet(Async)");
        }
        

        okhttp3.Call localVarCall = produitsProduitIdGetCall(produitId, _callback);
        return localVarCall;

    }

    /**
     * Retourne les détails du produit
     * 
     * @param produitId  (required)
     * @return Produit
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> JSON de du produit sélectionné </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public Produit produitsProduitIdGet(Long produitId) throws ApiException {
        ApiResponse<Produit> localVarResp = produitsProduitIdGetWithHttpInfo(produitId);
        return localVarResp.getData();
    }

    /**
     * Retourne les détails du produit
     * 
     * @param produitId  (required)
     * @return ApiResponse&lt;Produit&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> JSON de du produit sélectionné </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Produit> produitsProduitIdGetWithHttpInfo(Long produitId) throws ApiException {
        okhttp3.Call localVarCall = produitsProduitIdGetValidateBeforeCall(produitId, null);
        Type localVarReturnType = new TypeToken<Produit>(){}.getType();
        return localVarApiClient.execute(localVarCall, localVarReturnType);
    }

    /**
     * Retourne les détails du produit (asynchronously)
     * 
     * @param produitId  (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> JSON de du produit sélectionné </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdGetAsync(Long produitId, final ApiCallback<Produit> _callback) throws ApiException {

        okhttp3.Call localVarCall = produitsProduitIdGetValidateBeforeCall(produitId, _callback);
        Type localVarReturnType = new TypeToken<Produit>(){}.getType();
        localVarApiClient.executeAsync(localVarCall, localVarReturnType, _callback);
        return localVarCall;
    }
    /**
     * Build call for produitsProduitIdPut
     * @param produitId  (required)
     * @param inlineObject3  (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit modifié </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Produit introuvable, vérifié le produitId </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdPutCall(Long produitId, InlineObject3 inlineObject3, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = inlineObject3;

        // create path and map variables
        String localVarPath = "/produits/{produitId}"
            .replaceAll("\\{" + "produitId" + "\\}", localVarApiClient.escapeString(produitId.toString()));

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            "application/json"
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] { "JWT" };
        return localVarApiClient.buildCall(localVarPath, "PUT", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call produitsProduitIdPutValidateBeforeCall(Long produitId, InlineObject3 inlineObject3, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'produitId' is set
        if (produitId == null) {
            throw new ApiException("Missing the required parameter 'produitId' when calling produitsProduitIdPut(Async)");
        }
        
        // verify the required parameter 'inlineObject3' is set
        if (inlineObject3 == null) {
            throw new ApiException("Missing the required parameter 'inlineObject3' when calling produitsProduitIdPut(Async)");
        }
        

        okhttp3.Call localVarCall = produitsProduitIdPutCall(produitId, inlineObject3, _callback);
        return localVarCall;

    }

    /**
     * Modifier un produit
     * 
     * @param produitId  (required)
     * @param inlineObject3  (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit modifié </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Produit introuvable, vérifié le produitId </td><td>  -  </td></tr>
     </table>
     */
    public void produitsProduitIdPut(Long produitId, InlineObject3 inlineObject3) throws ApiException {
        produitsProduitIdPutWithHttpInfo(produitId, inlineObject3);
    }

    /**
     * Modifier un produit
     * 
     * @param produitId  (required)
     * @param inlineObject3  (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit modifié </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Produit introuvable, vérifié le produitId </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> produitsProduitIdPutWithHttpInfo(Long produitId, InlineObject3 inlineObject3) throws ApiException {
        okhttp3.Call localVarCall = produitsProduitIdPutValidateBeforeCall(produitId, inlineObject3, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     * Modifier un produit (asynchronously)
     * 
     * @param produitId  (required)
     * @param inlineObject3  (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> Produit modifié </td><td>  -  </td></tr>
        <tr><td> 401 </td><td> Le token d&#39;accès est invalide ou manquant </td><td>  -  </td></tr>
        <tr><td> 404 </td><td> Produit introuvable, vérifié le produitId </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call produitsProduitIdPutAsync(Long produitId, InlineObject3 inlineObject3, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = produitsProduitIdPutValidateBeforeCall(produitId, inlineObject3, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
}
