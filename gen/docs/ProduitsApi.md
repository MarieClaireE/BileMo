# ProduitsApi

All URIs are relative to *http://api.bilemo.com/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**produitsGet**](ProduitsApi.md#produitsGet) | **GET** /produits | Retourne la liste des produits
[**produitsPost**](ProduitsApi.md#produitsPost) | **POST** /produits | Création d&#39;un produit
[**produitsProduitIdDelete**](ProduitsApi.md#produitsProduitIdDelete) | **DELETE** /produits/{produitId} | Suppression d&#39;un produit
[**produitsProduitIdGet**](ProduitsApi.md#produitsProduitIdGet) | **GET** /produits/{produitId} | Retourne les détails du produit
[**produitsProduitIdPut**](ProduitsApi.md#produitsProduitIdPut) | **PUT** /produits/{produitId} | Modifier un produit


<a name="produitsGet"></a>
# **produitsGet**
> List&lt;Produit&gt; produitsGet()

Retourne la liste des produits

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProduitsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ProduitsApi apiInstance = new ProduitsApi(defaultClient);
    try {
      List<Produit> result = apiInstance.produitsGet();
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProduitsApi#produitsGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**List&lt;Produit&gt;**](Produit.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Liste des produits |  -  |

<a name="produitsPost"></a>
# **produitsPost**
> produitsPost(inlineObject2)

Création d&#39;un produit

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProduitsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ProduitsApi apiInstance = new ProduitsApi(defaultClient);
    InlineObject2 inlineObject2 = new InlineObject2(); // InlineObject2 | 
    try {
      apiInstance.produitsPost(inlineObject2);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProduitsApi#produitsPost");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inlineObject2** | [**InlineObject2**](InlineObject2.md)|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**201** | Produit créé |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

<a name="produitsProduitIdDelete"></a>
# **produitsProduitIdDelete**
> produitsProduitIdDelete(produitId)

Suppression d&#39;un produit

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProduitsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ProduitsApi apiInstance = new ProduitsApi(defaultClient);
    Long produitId = 2L; // Long | 
    try {
      apiInstance.produitsProduitIdDelete(produitId);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProduitsApi#produitsProduitIdDelete");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **produitId** | **Long**|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Produit supprimé. |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |
**404** | Le produit est introuvable. |  -  |

<a name="produitsProduitIdGet"></a>
# **produitsProduitIdGet**
> Produit produitsProduitIdGet(produitId)

Retourne les détails du produit

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProduitsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ProduitsApi apiInstance = new ProduitsApi(defaultClient);
    Long produitId = 2L; // Long | 
    try {
      Produit result = apiInstance.produitsProduitIdGet(produitId);
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProduitsApi#produitsProduitIdGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **produitId** | **Long**|  |

### Return type

[**Produit**](Produit.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | JSON de du produit sélectionné |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

<a name="produitsProduitIdPut"></a>
# **produitsProduitIdPut**
> produitsProduitIdPut(produitId, inlineObject3)

Modifier un produit

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProduitsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ProduitsApi apiInstance = new ProduitsApi(defaultClient);
    Long produitId = 2L; // Long | 
    InlineObject3 inlineObject3 = new InlineObject3(); // InlineObject3 | 
    try {
      apiInstance.produitsProduitIdPut(produitId, inlineObject3);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProduitsApi#produitsProduitIdPut");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **produitId** | **Long**|  |
 **inlineObject3** | [**InlineObject3**](InlineObject3.md)|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**201** | Produit modifié |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |
**404** | Produit introuvable, vérifié le produitId |  -  |

